<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Zan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PostController extends Controller
{
    //文章列表 依赖注入
    public function index(\Psr\Log\LoggerInterface $log){
        //获取容器
        //$app = app();
        //获取日志类
        //$log = $app->make('log');
        $log->info('post_index',['data' =>'this is post index2']);
        \Log::info('post_index',['data' =>'this is post index3']); //门面技术
        //get方法得到的是一个对象
        //$posts = Post::orderBy('created_at','desc')->get();
        $posts = Post::orderBy('created_at','desc')->withCount("comments")->paginate(6);//分页
        return view('post/index',compact('posts'));
    }

    //详情页面
    public function show(Post $post){
        //绑定模型?
        //$post = Post::find($id);
        //预加载
        $post->load('comments');
        return view('post/show',compact('post'));

    }

    //创建页面
    public function create(){
        return view('post/create');

    }

    //创建逻辑
    public function store(){
        //$params = ['title' =>  request('title'),'content' =>  request('content')];
        //dd(request(['title','content']));
        //数据验证
        $this->validate(request(),[
            'title' => 'required|string|max:50|min:5',
            'content' => 'required|string|min:6'
        ]);
        $user_id = \Auth::id();
        $params = array_merge(request(['title','content']),compact('user_id'));
        //创建文章逻辑
        Post::create($params);
        //渲染
        return redirect('/posts');

    }

    //编辑页面
    public function edit(Post $post){
        return view('post/edit',compact('post'));

    }

    //编辑逻辑
    public function update(){
        //数据验证
        $this->validate(request(),[
            'title' => 'required|string|max:50|min:5',
            'content' => 'required|string|min:6'
        ]);
        //$this->authorize('update',$post);
        //dd(request()->all());
        //修改文章逻辑
        $data['id'] = strip_tags(request('id'));
        $post = \App\Post::find($data['id']);
        $post->title = strip_tags(request('title'));
        $post->content = strip_tags(request('content'));
        $post->save();
        return redirect("/posts");

    }

    //删除逻辑
    public function delete($id){
        $post = \App\Post::find($id);
        $post->delete();
        return redirect("/posts");
    }

    //图片上传
    public function imageUpload(Request $request){
        //dd(123);
       $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
       return asset('storage/'.$path);

    }

    //提交评论
    public function comment(Post $post){
        //dd($post->comments());
        //验证
        $this->validate(request(),[
            'content' => 'required|min:3'
        ]);
        //逻辑
        $comment = new Comment();
        $comment->user_id = \Auth::id();
        $comment->post_id = (integer)request('post_id');
        $comment->content = request('content');
        $post->comments()->save($comment);
        //渲染
        return back();
    }

    //点赞
    public function zan(){
        $str = substr(request()->getRequestUri(),7);
        $params = [
           'user_id' => \Auth::id(),
            'post_id' => (integer)$str,
        ];
        //如果没有，创建，如果有，查找
        Zan::firstOrCreate($params);
        return back();
    }

    //取消点赞
    public function unzan(){
        $post_id = (integer)substr(request()->getRequestUri(),7);
        $zan = Zan::where(function ($query)  use($post_id){
            $query->where('post_id', $post_id);
        })->where('user_id', \Auth::id())->first();
        $zan->delete();
        return back();
    }
}
