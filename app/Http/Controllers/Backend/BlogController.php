<?php

namespace App\Http\Controllers\Backend;

use App\Blogs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['blog'] = Blogs::all()->sortBy('blog_must');
        return view('backend.blogs.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (strlen($request->blog_slug) > 3) {
            $slug = Str::slug($request->blog_slug);
        } else {
            $slug = Str::slug($request->blog_title);

        }


        if ($request->hasFile('blog_file')) {
            $request->validate([
                'blog_title' => 'required',
//                'blog_content' => 'required',
                'blog_file' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);
            $fileName = uniqid() . '.' . $request->blog_file->getClientOriginalExtension();
            $request->blog_file->move(public_path('images/blogs'), $fileName);
        } else {
            $fileName = null;
        }


        $blog = Blogs::insert([
            "blog_title" => $request->blog_title,
            "blog_slug" => $slug,
            "blog_file" => $fileName,
            "blog_content" => $request->blog_content,
            "blog_status" => $request->blog_status,

        ]);

        if ($blog) {
            return redirect(route('blog.index'))->with('success', 'Successfully added!');
        }

        return back()->with('error', 'Not successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blogs = Blogs::where('id', $id)->first();
        return view('backend.blogs.edit')->with('blogs', $blogs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (strlen($request->blog_slug) > 3) {
            $slug = Str::slug($request->blog_slug);
        } else {
            $slug = Str::slug($request->blog_title);

        }


        if ($request->hasFile('blog_file')) {
            $request->validate([
                'blog_title' => 'required',
//                'blog_content' => 'required',
                'blog_file' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);
            $fileName = uniqid() . '.' . $request->blog_file->getClientOriginalExtension();
            $request->blog_file->move(public_path('images/blogs'), $fileName);

            $blog = Blogs::where('id', $id)->update([
                "blog_title" => $request->blog_title,
                "blog_slug" => $slug,
                "blog_file" => $fileName,
                "blog_content" => $request->blog_content,
                "blog_status" => $request->blog_status,

            ]);

        } else {
            $blog = Blogs::where('id', $id)->update([
                "blog_title" => $request->blog_title,
                "blog_slug" => $slug,
                "blog_content" => $request->blog_content,
                "blog_status" => $request->blog_status,

            ]);
        }

        $path = 'images/blogs/' . $request->oldFile;
        if (file_exists($path)) {
            @unlink(public_path($path));
        }


        if ($blog) {
            return back()->with('success', 'Successfully added!');
        }

        return back()->with('error', 'Not successfully added!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blogs::find(intval($id));
        if ($blog->delete()) {
            echo 1;
        }
        echo 0;
    }

    public function sortable()
    {
//        print_r($_POST['item']);

        foreach ($_POST['item'] as $key => $value) {
            $blogs = Blogs::find(intval($value));
            $blogs->blog_must = intval($key);
            $blogs->save();
        }

        echo true;
    }
}
