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
        $contacts = Contact::paginate(10);
        return view('contact.index', [
            'contacts' => $contacts
        ]);
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
                return redirect()->route('index');
            } catch (\Exception $e) {
                $this->handleError();
            }
        }

        return redirect()->route('index')->withErrors($validation->errors()->first());

    }

    //Return the Contact Edit Page
    public function edit($id)
    {
        if (is_numeric($id)) {

            return view('contact.create-edit', [
                'contact' => Contact::where('id', $id)->first()
            ]);
        }
        $this->handleError();
    }

    //Update Contact into the database
    public function update(Request $request)
    {
        $validation = $this->validation($request->all());

        if (!$validation->fails()) {

            $this->save($request->all());

            Session::flash('success', 'Contact updated with success!');
            return redirect()->route('index');
        } else {
            dd($validation->errors());
            return redirect()->route('index')->withErrors($validation->errors()->first());

        }
    }

    //Delete the Contact from the database
    public function delete(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'id' => 'required|numeric'
        ]);
        if (!$validation->fails()) {
            try {
                $contact = Contact::find($request->id);
                DB::beginTransaction();
                $contact->delete();
                DB::commit();

                Session::flash('success', 'Contact updated with success!');
                return redirect()->route('index');
            } catch (\Exception $e) {
                $this->handleError($e, true);
            }
        } else {
            return redirect()->route('index')->withErrors($validation->errors()->first());
        }
    }

    //Return the Contact Details Page
    public function read($id)
    {
        if (is_numeric($id)) {

            return view('contact.info', [
                'contact' => Contact::where('id', $id)->first()
            ]);
        }
    }

    //Validation Method for the create/edit form
    private function validation($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|min:5',
            'contact' => 'required|numeric|digits:9',
            'email' => 'required|email'
        ]);

        $isEdit = str_contains(url()->previous(), 'edit');

        $validator->sometimes('id', 'required|numeric', function() use ($isEdit){
            return $isEdit;
        });

        $validator->sometimes('email', 'unique:contacts,email', function() use ($isEdit){
            return !$isEdit;
        });

        $validator->sometimes('contact', 'unique:contacts,contact', function() use ($isEdit){
            return !$isEdit;
        });
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
            $this->handleError($e, true);
        }
    }

    //Handle errors Method
    private function handleError(\Exception $exception = null, $rollBack = false)
    {

        if (isset($exception)) {
            Log::error($exception->getMessage());
        }
        if ($rollBack) {
            DB::rollBack();
        }

        return redirect()->route('index')->withErrors('Internal Error! Try Again Later');
    }
}
