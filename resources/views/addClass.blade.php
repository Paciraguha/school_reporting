@extends('layouts.doslayout')

@section('content')
<style>
  
    .count-input{
        background:yellow;
        display:flex;
        flex-direction:row;
        align-content:center;
        justify-content:space-around
    }
    .count-input div{
        width:100px;
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:space-around
    }
</style>
<div class="container"  style="padding-left:20px;padding-right:20px;margin-right:50px;margin:auto">
<!--  create new class ------------------------------------------------------------------- -->
<div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Register new School class
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="#"> 
                            <div>
                               <label for="class-section" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Level</label>
                                <select  id="class-section" class="bg-gray-50  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    <option>Select level</option>
                                    
                                </select>
                            </div>
                            <div>
                            <label for="class-level" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Class Name</label>
                            <input type ="text" id="className" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="" placeholder="S4 MCB A"/>
                            <small>Example: S5 LKK A , P1 A or S3 E</small>
                            </div>
                            <!-- <div>
                               <label for="class-level" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Class Name</label>
                               <select c id="class-level" class="bg-gray-50  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    <option>Select Class</option>
                                    <option value="N1">N1</option>
                                    <option value="N2">N2</option>
                                    <option value="N3">N3</option>
                                    <option value="P1">P1</option>
                                    <option value="P2">P2</option>
                                    <option value="P3">P3</option>
                                    <option value="P4">P4</option>
                                    <option value="P5">P5</option>
                                    <option value="P6">P6</option>
                                    <option value="S1">S1</option>
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                    <option value="S4">S4</option>
                                    <option value="S5">S5</option>
                                    <option value="S6">S6</option>
                                    <option value="L1">L1</option>
                                    <option value="L2">L2</option>
                                    <option value="L3">L3</option>
                                </select>
                            </div>
                            <div>
                            <label for="class-level" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Class section</label>
                                <select  id="class-part" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    <option>Select section</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    <option value="F">F</option>
                                    <option value="G">G</option>
                                    <option value="H">H</option>
                                    <option value="I">I</option>
                                    <option value="J">J</option>
                                    <option value="L">L</option>
                                </select>
                            </div> -->
                              
                   <button  type="button" id="addClass-button"  class="w-full text-white bg-black-700 bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add Class</button>
                </form>
            </div>
        </div>
    </div>
</div> 


<!--  update  class information------------------------------------------------------------------- -->
<div id="authentication-modal-update" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    update class information
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal-update">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="#"> 
                            <div>
                            <label for="class-level" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Class id</label>
                            <input type ="text" id="classId-update" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="" readonly/>
                            </div>   
                            <div>
                               <label for="class-section-update" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Level</label>
                                <select  id="class-section-update" class="bg-gray-50  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    <option>Select level</option>
                                    
                                </select>
                            </div>
                            <div>
                            <label for="class-level" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Class Name</label>
                            <input type ="text" id="className-update" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="" placeholder="S4 MCB A"/>
                            <small>Example: S5 LKK A , P1 A or S3 E</small>
                        </div> 

                   <button  type="button" id="addClass-button-update"  class="w-full text-white bg-black-700 bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                </form>
            </div>
        </div>
    </div>
</div> 

            <div class="flex flex-col w-full md:w-[100%]  border border-amber-300 px-5 py-8 mt-12">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" 
                        class="w-[150px] float-end text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" 
                        type="button">
                            Add new class
                    </button>
                    <h3 class="py-2 border-b-2 border-red-900 my-4 w-full" id="table-title">
                        {{ __("Class section in school") }}
                    </h3>
                    <div class="overflow-hidden mx-auto">
                    <table class="display min-w-[80%] text-left text-sm font-light text-surface dark:text-white mx-auto" >
                            <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                            <tr>
                                <td rowspan="2" class="px-6 py-4">No</td>
                                <td rowspan="2" class="px-6 py-4">Date of Registration</td>
                                <td class="px-6 py-4">School Classes </td>
                                <td class="px-6 py-4" colspan="3">Actions</td>
                            </tr>
                        </thead>
                        <tbody id="class-section-table">
                        
                        </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- submit button ----------------------------------------- -->
</div>

<script>
   const token = localStorage.getItem('auth_token');
 $(document).ready(function() {
    getAllClass()
    getClassLevelsOfSchool()
    $("#addClass-button").click(function(){
        addNewClassToSchool()
    })
 $("#addClass-button-update").click(function(){
    updateClassInformation()
})
    function getClassLevelsOfSchool(){
    const school_levels=document.getElementById("class-section")
    $.ajax({
        type: 'GET',
        url: '{!! route('getClassLevelsOfSchool') !!}',
        headers: {
            'Authorization': 'Bearer ' + token,
            "Content-Type":"application/json"
             },
        dataType: 'json',
        success: function(response) {
            const data=response;
            let i=0;
            data.SchoolLevels.forEach((res)=>{
            console.log(res)
           i++
           const options=`
                <Option value="${res.id}">${res.levels}</Option>
            `
            school_levels.insertAdjacentHTML("beforeend",options);
        })

        },
        error: function(xhr, status, error) {
            // Handle errors if needed
            console.log(error);
        }
    });
}


function getAllClass(){
    const SchoolClass=document.getElementById("class-section-table")
    $.ajax({
        type: 'GET',
        url: '{!! route('apiGetSchoolClass') !!}',
        headers: {
            'Authorization': 'Bearer ' + token
             },
        dataType: 'json',
        success: function(response) {

            const data=response;
            let i=0;
            data.forEach((response)=>{
           
           i++

                const classStudent = `/studentinclass/${response.id}`;
                const studendentInClass=`/dosStdudentInClass?studentsClass=${response.id}`
            const table1=`
            <tr class="border-b border-neutral-200 dark:border-white/10 tr-data">
                <td class="whitespace-nowrap px-6 py-4">${i}</td>
                <td class="whitespace-nowrap px-6 py-4">${response.created_at.split("T")[0]}</td>
                <td class="whitespace-nowrap px-6 py-4">${response.SchoolClass}</td>
                <td class="whitespace-nowrap px-6 py-4 flex justify-evenly">
                 <a  href="${classStudent}" class="bg-blue hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"> Attendance statistic</button>
                 <a  href="${studendentInClass}" class="btn btn-success">Daily Attendance</button>
                 <a onClick='updateClass(${JSON.stringify(response)})' href="#" class="btn btn-warning" data-modal-target="authentication-modal-update" data-modal-toggle="authentication-modal-update"> Edit class info</a></td>
            </tr>
            `

            SchoolClass.insertAdjacentHTML("beforeend",table1);
          
        })
        
        },
        error: function(xhr, status, error) {
            // Handle errors if needed
            console.error(error);
        }
    });
}







function formValue(){

let class_section=document.getElementById("class-section").value
let class_name=document.getElementById("className").value
// let classes_levels=document.getElementById("class-level").value
// let class_part=document.getElementById("class-part").value

const data={
    SchoolClass:class_name,
    ClassSection:class_section
   
}
console.log(data)
return data
}

function addNewClassToSchool(){
           const formData =formValue();
            // Send an AJAX request
            $.ajax({
                type: 'POST',
                url: '{!! route('apiAddSchoolClass') !!}',
                headers: {
                'Authorization': 'Bearer ' + token
               
                },
                data: formData,
                dataType: 'json',
                success: function(response) {
                    //console.log(response)
                    window.location.reload()
                },
                error: function(xhr, status, error) {
                    // Handle errors if needed
                    console.error(error);
                }
            });
        }
})

function updateClass(class_info){
   
    let classCategory=document.getElementById("class-section-update")
    document.getElementById("className-update").value=class_info.SchoolClass
    document.getElementById("classId-update").value=class_info.id

    $.ajax({
        type: 'GET',
        url: '{!! route('getClassLevelsOfSchool') !!}',
        headers: {
            'Authorization': 'Bearer ' + token,
            "Content-Type":"application/json"
             },
        dataType: 'json',
        success: function(response) {
            const data=response;
            data.SchoolLevels.forEach((res)=>{
           const options=`
                <Option ${res.id==class_info.classLevel?"selected":""} value="${res.id}">${res.levels}</Option>
            `
            classCategory.insertAdjacentHTML("beforeend",options);
        })
        },

    })
}

function formValueUpdate(){
let class_id=document.getElementById("classId-update").value
let class_section=document.getElementById("class-section-update").value
let class_name=document.getElementById("className-update").value

const data={
    class_id,
    SchoolClass:class_name,
    ClassSection:class_section
   
}
console.log(data)
return data
}


function updateClassInformation(){
    const formData=formValueUpdate()
    $.ajax({
        type: 'POST',
        url: '{!! route('schoolUpdateClass') !!}',
        headers: {
            'Authorization': 'Bearer ' + token
             },
        
         data: formData,
        dataType: 'json',
        success: function(response) {
            const data=response;
            alert(response.message)
            window.location.reload()
          //console.log("---------------------------------",data)
        },

    })
}

</script>
@endsection


