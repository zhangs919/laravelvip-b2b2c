<?php

namespace App\Http\Controllers;

use App\Transformers\UserTransformer;
use App\User;
use Dingo\Api\Http\Request;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller as BaseController;

/**
 * @Resource("Users")
 */
class TestController extends BaseController
{

    use Helpers;

    /**
     * Show all users
     *
     * Get a JSON representation of all the registered users.
     *
     * @Get("/{?page,limit}")
     * @Versions({"v1"})
     * @Parameters({
     *      @Parameter("page", type="integer", required=true, description="The page of results to view.", default=1),
     *      @Parameter("limit", description="The amount of results per page.", default=10)
     * })
     */
    public function index()
    {
//        $users = User::all();
//        return $this->response->collection($users, new UserTransformer());

//        $users = User::paginate(15);
//        return $this->response->paginator($users, new UserTransformer());


//        return $this->response->noContent();

//        $location = '123';
//        return $this->response->created($location);

        // A generic error with custom message and status code.
//        return $this->response->error('This is an error.', 404);

// A not found error with an optional message as the first parameter.
//        return $this->response->errorNotFound();

// A bad request error with an optional message as the first parameter.
//        return $this->response->errorBadRequest();

// A forbidden error with an optional message as the first parameter.
//        return $this->response->errorForbidden();

// An internal error with an optional message as the first parameter.
//        return $this->response->errorInternal();

// An unauthorized error with an optional message as the first parameter.
//        return $this->response->errorUnauthorized();

        $users = User::all();
//        return $this->response->item($users, new UserTransformer())->withHeader('X-foo', 'bar');
//        return $this->response->item($users, new UserTransformer())->addMeta('foo', 'bar');

        /*$meta_array = [
            'foo1' => 'bar1',
            'foo2' => 'bar2'
        ];
        return $this->response->item($users, new UserTransformer())->setMeta($meta_array);*/

        return $this->response->item($users, new UserTransformer())->setStatusCode(200);

    }
    
    public function show($id)
    {
        $user = User::findOrFail($id);
//        return $this->response->array($user->toArray());
        return $this->response->item($user, new UserTransformer());

    }

    public function save($id, Request $request)
    {

    }

    /**
     * Register user
     *
     * Register a new user with a `username` and `password`.
     *
     * @Post("/")
     * @Versions({"v1"})
     * @Transaction({
     *      @Request({"username": "foo", "password": "bar"}),
     *      @Response(200, body={"id": 10, "username": "foo"}),
     *      @Response(422, body={"error": {"username": {"Username is already taken."}}})
     * })
     */
    public function store()
    {

    }
}
