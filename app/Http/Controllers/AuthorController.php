<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     * Return the list of authors.
     *
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::all();

        return $this->successResponse($authors);
    }


    /**
     * Create new author.
     *
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'gender' => 'required|max:255|in:male, female',
            'country' => 'required|max:255',
        ];

        $this->validate($request, $rules);

        $author = Author::create($request->all());

        return $this->successResponse($author, Response::HTTP_CREATED);

    }


    /**
     * Show the details of a existing author.
     *
     * @return Illuminate\Http\Response
     */
    public function show($author_id)
    {
        $author = Author::where('author_id', $author_id)->firstOrFail();
        
        return $this->successResponse($author);
    }


    /**
     * Update attributes of a existing author.
     *
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $author_id)
    {
        $rules = [
            'name' => 'max:255',
            'gender' => 'max:255|in:male, female',
            'country' => 'max:255',
        ];

        $this->validate($request, $rules);

        $author = Author::where('author_id', $author_id)->firstOrFail();


        $author->fill($request->all());

        if($author->isClean()) {
            return $this->errorResponse('É preciso pelo menos um valor para atualizar', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        dd($author);
        
        $author->save();
        
        return $this->successResponse($author);
    }


    /**
     * Delete a existing author.
     *
     * @return Illuminate\Http\Response
     */
    public function destroy($author_id)
    {

    }
}
