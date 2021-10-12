<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Marriage;

class FamilyControllers extends Controller
{
    public function getFatherList()
    {
        return User::where('id', '!=', auth()->user()->id)->where('gender', User::GENDER['MALE'])->get();
    }
    public function getMotherList()
    {
        return User::where('id', '!=', auth()->user()->id)->where('gender', User::GENDER['FEMALE'])->get();
    }
    public function getWifeList()
    {
        return User::where('mother_id', '!=', auth()->user()->mother_id)->where('gender', User::GENDER['FEMALE'])->get();
    }
    public function getHusbandList()
    {
        return User::where('father_id', '!=', auth()->user()->father_id)->where('gender', User::GENDER['MALE'])->get();   
    }

    public function setHusband(Request $request)
    {
        $request->validate(
            [
                'husband_id' => 'nullable',
                'husband_name' => 'required_without:husband_id|max:255',
                'marriage_date' => 'required'
            ]
        );

        if ($request->husband_id) {
            $request->user()->save();
        } else {
            $husband = new User;
            $husband->name = $request->husband_name;
            $husband->gender = User::GENDER['MALE'];

            $request->user()->setHusband($husband, $request->marriage_date);
        }

        return response()->json(['message' => 'Husband has been added successfully!']);
    }

    public function setChild(Request $request)
    {
        $request->validate(
            [
                'child_name' => 'required|max:255',
                'gender' => 'in:male,female',
                'bod' => 'required|date'
            ]
        );
        DB::beginTransaction();
        try{
            $child = new User;
            $child->name = $request->child_name;
            $child->gender = $request->gender;
            $child->parent_id = $request->pivot_id;
            $child->date_of_birth = $request->bod;

            if ($request->pivot_id) {
                $marriage = Marriage::find($request->pivot_id);
                $child->father_id = $marriage->husband_id;
                $child->mother_id = $marriage->wife_id;
                $child->parent_id = $marriage->id;
            } else {
                if (auth()->user()->gender === User::GENDER['MALE']) {
                    $child->setFather(auth()->user());
                } else {
                    $child->setMother(auth()->user());
                }
            }
            $child->save();

            DB::commit();
            return response()->json(['message' => 'Added Child successfully']);

        }catch(\Exception $e){
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function setWife(Request $request)
    {
        $request->validate(
            [
                'wife_id' => 'nullable',
                'wife_name' => 'required_without:wife_id|max:255',
                'marriage_date' => 'required|date'
            ]
        );

        if ($request->wife_id) {
            $request->user()->save();
        } else {
            $wife = new User;
            $wife->name = $request->wife_name;
            $wife->gender = User::GENDER['FEMALE'];

            $request->user()->setWife($wife, $request->marriage_date);
        }
        return response()->json(['message' => 'Wife has been added successfully!']);
    }

    public function setFather(Request $request)
    {
        $request->validate(
            [
                'father_id' => 'nullable',
                'father_name' => 'required_without:father_id|max:255'
            ]
        );

        if ($request->father_id) {
            $request->user()->father_id = $request->father_id;
            $request->user()->save();
        } else {
            $father = new User;
            $father->name = $request->father_name;
            $father->gender = User::GENDER['MALE'];

            $request->user()->setFather($father);
        }

        return response()->json(['message' => 'Father has been added successfully!']);
    }

    public function setMother(Request $request)
    {
        $request->validate(
            [
                'mother_id' => 'nullable',
                'mother_name' => 'required_without:mother_id|max:255'
            ]
        );

        if ($request->mother_id) {
            $request->user()->mother_id = $request->mother_id;
            $request->user()->save();
        } else {
            $mother = new User;
            $mother->name = $request->mother_name;
            $mother->gender = User::GENDER['FEMALE'];

            $request->user()->setMother($mother);
        }

        return response()->json(['message' => 'Mother has been added successfully!']);
    }
}
