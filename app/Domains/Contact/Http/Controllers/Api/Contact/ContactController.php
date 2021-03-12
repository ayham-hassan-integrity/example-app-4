<?php

namespace App\Domains\Contact\Http\Controllers\Api\Contact;

use App\Http\Controllers\Controller;
use App\Domains\Contact\Models\Contact;
use Illuminate\Http\Request;

/**
 * Class ContactController.
 */
class ContactController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/contact",
     * summary="Get All Contacts",
     * description="Show All Contacts",
     * operationId="getAllContacts",
     * tags={"Contact"},
     * @OA\Response(
     *    response=200,
     *    description="Returns when Contact are found",
     *    @OA\JsonContent(
     *     @OA\Items(
     *       @OA\Property(property="name", type="string", example="1"),
     *       @OA\Property(property="id", type="increments", example="1"),
     *       @OA\Property(property="description", type="string", example="1"),
     *       @OA\Property(property="deleted_at", type="string", example="null"),
     *       @OA\Property(property="created_at", type="string", example="2021-03-10T09:03:27.000000Z"),
     *       @OA\Property(property="updated_at", type="string", example="2021-03-10T09:03:27.000000Z"),
     *    )
     * )
     * )
     * )
     */
    public function index()
    {
        return Contact::all();
    }



    /**
     * @OA\Get(
     * path="/api/contact/{id}",
     * summary="Get Contact by id",
     * description="Show one Contact by id",
     * operationId="getOneContacts",
     * tags={"contact"},
     * @OA\Parameter(
     *    description="ID of contact",
     *    in="path",
     *    name="id",
     *    required=true,
     *    example="1",
     * ),
     * @OA\Response(
     *    response=404,
     *    description="Returns when contact id is not found",
     *    @OA\JsonContent(
     *       @OA\Property(property="error", type="string", example="Resource not found"),
     *    )
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Returns when Contact is found",
     *    @OA\JsonContent(
     *       @OA\Property(property="name", type="string", example="1"),
     *       @OA\Property(property="id", type="increments", example="1"),
     *       @OA\Property(property="description", type="string", example="1"),
     *       @OA\Property(property="deleted_at", type="string", example="null"),
     *       @OA\Property(property="created_at", type="string", example="2021-03-10T09:03:27.000000Z"),
     *       @OA\Property(property="updated_at", type="string", example="2021-03-10T09:03:27.000000Z"),
     *    )
     * )
     * )
     * )
     */
    public function show(Contact $contact)
    {
        return $contact;
    }

    /**
     * @OA\Post (
     * path="/api/contact",
     * summary="Create New Contact",
     * description="Create One Contact",
     * operationId="postOneContacts",
     * tags={"contact"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Contact fields",
     *    @OA\JsonContent(
     *       required={"name"},
     *       @OA\Property(property="name", type="string", example="1"),
     *       @OA\Property(property="id", type="increments", example="1"),
     *       @OA\Property(property="description", type="string", example="1"),
     *    ),
     * ),
     * @OA\Response(
     *    response=401,
     *    description="Returns when name or description deos'nt o the RequestBody ",
     *    @OA\JsonContent(
     *       @OA\Property(property="error", type="string", example="name and description field are required"),
     *    )
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Returns when Contact has been created",
     *    @OA\JsonContent(
     *     @OA\Items(
     *       @OA\Property(property="name", type="string", example="1"),
     *       @OA\Property(property="id", type="increments", example="1"),
     *       @OA\Property(property="description", type="string", example="1"),
     *       @OA\Property(property="created_at", type="string", example="2021-03-10T09:03:27.000000Z"),
     *       @OA\Property(property="updated_at", type="string", example="2021-03-10T09:03:27.000000Z"),
     *    )
     * )
     * )
     * )
     */

    public function store(Request $request)
    {
        $contact = Contact::create($request->all());
        return response()->json($contact, 201);
    }

    /**
     * @OA\Put  (
     * path="/api/contact/{id}",
     * summary="Edit one Contact by id",
     * description="update One Contact by id",
     * operationId="postOneContacts",
     * tags={"contact"},
     * @OA\Parameter(
     *    description="ID of contact",
     *    in="path",
     *    name="id",
     *    required=true,
     *    example="1",
     * ),
     * @OA\RequestBody(
     *    required=false,
     *    description="Contact fields",
     *    @OA\JsonContent(
     *       @OA\Property(property="name", type="string", example="1"),
     *       @OA\Property(property="id", type="increments", example="1"),
     *       @OA\Property(property="description", type="string", example="1"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Returns when Contact has been created",
     *    @OA\JsonContent(
     *     @OA\Items(
     *       @OA\Property(property="name", type="string", example="1"),
     *       @OA\Property(property="id", type="increments", example="1"),
     *       @OA\Property(property="description", type="string", example="1"),
     *       @OA\Property(property="created_at", type="string", example="2021-03-10T09:03:27.000000Z"),
     *       @OA\Property(property="updated_at", type="string", example="2021-03-10T09:04:27.000000Z"),
     *    )
     * )
     * )
     * )
     */

    public function update(Request $request, Contact $contact)
    {
        $contact->update($request->all());

        return response()->json($contact, 200);
    }

    /**
     * @OA\Delete (
     * path="/api/contact/{id}",
     * summary="delete Contact by id",
     * description="delete one Contact by id",
     * operationId="deleteOneContacts",
     * tags={"contact"},
     * @OA\Parameter(
     *    description="ID of contact",
     *    in="path",
     *    name="id",
     *    required=true,
     *    example="1",
     * ),
     * @OA\Response(
     *    response=404,
     *    description="Returns when contact id is not found",
     *    @OA\JsonContent(
     *       @OA\Property(property="error", type="string", example="Resource not found"),
     *    )
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Returns when Contacts are found",
     *    @OA\JsonContent(
     *       @OA\Property(property="name", type="string", example="1"),
     *       @OA\Property(property="id", type="increments", example="1"),
     *       @OA\Property(property="description", type="string", example="1"),
     *       @OA\Property(property="deleted_at", type="string", example="2021-03-10T15:47:13.000000Z"),
     *       @OA\Property(property="created_at", type="string", example="2021-03-10T09:03:27.000000Z"),
     *       @OA\Property(property="updated_at", type="string", example="2021-03-10T09:03:27.000000Z"),
     *    )
     * )
     * )
     * )
     */
    public function delete(Contact $contact)
    {
        $contact->delete();

        return response()->json($contact, 200);
    }
}