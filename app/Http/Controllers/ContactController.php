<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

/**
 * Controller for contact CRUD
 *
 * @author João Victor Oliveira <joaovictorocosta@gmail.com>
 * @since 23/04/2022
 * @version 1.0.0
 */
class ContactController extends Controller
{
    //List contacts
    public function index()
    {
        # code...
    }

    //Return the Contact Creation Page
    public function create()
    {
        return view('contact.create-edit', [
            'contact' => new Contact()
        ]);
    }

    //Insert the Contact into the database
    public function insert(Request $request)
    {
        $validation = $this->validation($request->all());

        if (!$validation->fails()) {

            try {
                $this->save($request->all());

                Session::flash('success', 'Contact added with success!');
                return redirect('/contact', Response::HTTP_CREATED);
            } catch (\Exception $e) {
                Session::flash('error', "Internal Error! Try Again Later");
                return redirect('/contact', Response::HTTP_BAD_REQUEST);
            }
        }

        Session::flash('error', $validation->errors()->first());
        return redirect('/contact', Response::HTTP_BAD_REQUEST);
    }

    //Return the Contact Edit Page
    public function edit($id)
    {
        if (is_numeric($id)) {

            return view('contact.create-edit', [
                'contact' => Contact::where('id', $id)->first()
            ]);
        }
        Session::flash('error', "Internal Error! Try Again Later");
        return redirect('/contact', Response::HTTP_BAD_REQUEST);
    }

    //Update Contact into the database
    public function update(Request $request)
    {
        $validation = $this->validation($request->all());

        if (!$validation->fails()) {

            $this->save($request->all());

            Session::flash('success', 'Contact updated with success!');
            return redirect('/contact');
        } else {
            dd('aq2');
            Session::flash('error', $validation->errors()->first());
            return redirect('/contact', Response::HTTP_BAD_REQUEST);
        }
    }

    //Delete the Contact from the database
    public function delete(Request $request)
    {
        dd($request->all());
    }

    //Return the Contact Details Page
    public function read($id)
    {
        # code...
    }

    //Validation Method for the create/edit form
    private function validation($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|min:5',
            'contact' => 'required|numeric|digits:9|unique:contacts,contact',
            'email' => 'required|email|unique:contacts,email'
        ]);

        return $validator;
    }

    //Database insertion Method
    private function save($data)
    {
        try {
            $contact = isset($data['id']) ? Contact::where('id', $data["id"])->first() : new Contact();

            DB::beginTransaction();
            $contact->name = $data['name'];
            $contact->contact = $data['contact'];
            $contact->email = $data['email'];
            $contact->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            Session::flash('error', "Internal Error! Try Again Later");
            return redirect('/contact', Response::HTTP_BAD_REQUEST);
        }
    }
}
