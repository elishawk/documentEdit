<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    //
    public function index (){

        //$posts= DB::select('select * from posts');

        //if you need a where clause you can do this
        //$posts= DB::select('select * from posts where id = ?',[3]);

        //if you dont like the question mark
        //$posts= DB::select('select * from posts where id = :id',['id'=>3]);
        //these statements above are however not using a query builder

        
        //fetching specific id
       /* 
       $id = 2;
        $posts= DB::table('posts')
        ->where('id',$id)
        ->get();

        */

        //fetching a specific row
        // $posts=DB::table('posts')
        // ->select('body')
        // ->get();

        //using where clause with three parameters comparing whether the created time is greater or lesser than now
       
       // $posts=DB::table('posts')
        
       //->where('created_at','>',now()->subDay())
        
        //the orwhere is called when the where is found not to be true
        //->orWhere('title','Prof.')
        
        // the where between returns rows where the value is between two colums ie
        //->whereBetween('id', [1,2])
        
        //we can select columns that are not null
        //->whereNotNull('title')

        // you can also use whereraw but this can expose your app to sql attacks as it allows raw unescaped strings

        //the distinct allows selection of only unique rows
        //->select('title')
        //->distinct()

        //we can arrange data using different methods
        //order by  the title and make it to be ascending
        //->orderBy('title','asc')

        //arrenges them by latest
        //->latest()

        //arrenges it by oldes
       // ->oldest()

       //you can also order  them in random order
       //->inRandomOrder()
       // ->get();
//**************************************************************************************** */
       //other returning methodss exist apart from the get()
    //    $id=3;
    //    $posts=DB::table('posts')

       //using the orderby , the first allows yu to get the first most result
    //    ->orderBy('created_at','desc')
    //    ->first();

    //we can use find to fetch a specific column ie one with an id
    //this will return a null if the desire record isnt found
    //->find(10);
    
    //this gives you the total row count
    // ->count();

    //INSERTING DATA
    
    // $posts = DB::table('posts')
    // ->insert([
    //     'title'=>'Shocking posts',
    //     'body'=>'I am very very shocked by the news'
    // ]);
  
    //UPDATING THE DATA
   
    // $posts= DB::table('posts')
    // //the where here is taking three parameters
    // ->where('id','=',5)
    // ->update([
    //     'title'=>'My first update',
    //     'body'=>'Hello guys welcome to my youtube channel'
    // ]);

    //DELETING THE DATA

    //no parameters are required in the delete since we have a where parameter
    $posts = DB::table('posts')
    ->where('id','=',5)
    ->delete();
        dd($posts);
    }
}
