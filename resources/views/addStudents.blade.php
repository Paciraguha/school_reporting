@extends('layouts.school')

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

<div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Register new School
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
                    <label for="class-level" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sector</label>
                        <select class="form-control" id="sector-options" class="bg-gray-50  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                            <option>Select Sector</option>
                            </select>
                    </div>
                    <div>
                    <label for="class-level" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sector</label>
                        <select class="form-control" id="school-options"  class="bg-gray-50  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                            <option>Select School</option>
                            </select>
                    </div>
                    <div>
                    <label for="class-level" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sector</label>
                        <select class="form-control" id="class-options"  class="bg-gray-50  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                            <option>Select class</option>
                        </select>
                    </div>
                    <div >
                        <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" id="firstName" placeholder="first name"> 
                    </div>
                    <div>
                        <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" id="lastName" placeholder="last name"> 
                    </div>
                    <div>
                    <label for="class-level" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sector</label>
                        <select class="form-control" id="gender-options"  class="bg-gray-50  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                            <option>Gender</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                        </select>
                    </div>  
                    <div class="col-md-6">
                        <button type="button"  id="addHeadTeacher-button">Add Student</button>
                    </div>
                    </div>
                </div>
            </div> 
        </div>


                 <div class="w-full flex flex-col mt-[50px">
                 <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" 
                        class="w-[150px] float-right text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" 
                        type="button">
                            Add new student
                    </button>
                            <h3 class="py-2 border-b-2 border-red-900 my-4 w-full" id="table-title">
                                  {{ __("students list of school") }}
                            </h3>
                            <table class="min-w-full text-left text-sm font-light text-surface dark:text-white" >
                            <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                       
                            <tr>
                                <td rowspan="2" class="px-6 py-4">No</td>
                                <td class="px-6 py-4"> School Code</td>
                                <td class="px-6 py-4"> Student Code</td>
                                <td class="px-6 py-4"> Class Level</td>
                                <td class="px-6 py-4">FirstName</td>
                                <td class="px-6 py-4">LastName</td>
                                <td class="px-6 py-4">Gender</td>
                                <td colspan="2" class="px-6 py-4">Actions</td>
                            </tr>
                        </thead>
                        <tbody id="student-section-table">
                        
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
    getSectorInfo()
    getAllStudent()
    $("#addHeadTeacher-button").click(function(){
        addNewHeadTeacher()
    })

    $("#sector-options").change(function(){
        getAllSchool()
    })

    $("#school-options").change(function(){
        getAllSchoolClasses()
    })
    

function getSectorInfo(){
    const sector=document.getElementById("sector-options")
    $.ajax({
        type: 'GET',
        url: '{!! route('getAllSectors') !!}',
        headers: {
            'Authorization': 'Bearer ' + token,
            "Content-Type":"application/json"
             },
        dataType: 'json',
        success: function(response) {
            const data=response;
            let i=0;
            data.forEach((response)=>{
           i++
            const options=`
                <Option value="${response.SectorCode}">${response.SectorName}</Option>
            `
           sector.insertAdjacentHTML("beforeend",options);
        })

        },
        error: function(xhr, status, error) {
            // Handle errors if needed
            console.error(error);
        }
    });
}


function getAllSchool(){

    const school = document.getElementById("school-options");
    const sector = document.getElementById("sector-options").value;
    const url = `/api/schools/${sector}`;

    const myNode = document.getElementById("school-options");
    while (myNode.firstChild) {
        myNode.removeChild(myNode.lastChild);
    }

    const options=`
        <Option>select school in this sector</Option>
        `
    school.insertAdjacentHTML("beforeend",options);

    //console.log(sector)
    $.ajax({
        type: 'GET',
        url:url,
        headers: {
            'Authorization': 'Bearer ' + token,
            "Content-Type":"application/json"
             },
        dataType: 'json',
        success: function(response) {
            const data=response;
            console.log(data)
            let i=0;
            data.forEach((response)=>{

           i++
            const options=`
                <Option value="${response.SchoolCode}">${response.SchoolName}</Option>
            `
           school.insertAdjacentHTML("beforeend",options);
        })
        },
        error: function(xhr, status, error) {
            // Handle errors if needed
            console.error(error);
        }
    });
}


        function getAllSchoolClasses(){
        const classes= document.getElementById("class-options");
        const school = document.getElementById("school-options").value;
        //const url = `/api/schools/${sector}`;
        const url=`/api/schoolClasses/${school}`;
        const myNode = document.getElementById("class-options");
        while (myNode.firstChild) {
            myNode.removeChild(myNode.lastChild);
        }
        const options=`
            <Option>select school in this sector</Option>
            `
        classes.insertAdjacentHTML("beforeend",options);

        //console.log(sector)
        $.ajax({
            type: 'GET',
            url:url,
            headers: {
            'Authorization': 'Bearer ' + token,
            "Content-Type":"application/json"
             },
            dataType: 'json',
            success: function(response) {
                const data=response;
                console.log(data)
                let i=0;
                data.forEach((response)=>{
                i++
                const options=`<Option value="${response.id}">${response.SchoolClass}</Option> `
                classes.insertAdjacentHTML("beforeend",options);
            })
            },
            error: function(xhr, status, error) {
                // Handle errors if needed
                console.error(error);
            }
        });
        }
        function formValue(){
        // alert("testttt")
        let SectorCode=document.getElementById("sector-options").value
        let SchoolCode=document.getElementById("school-options").value
        let ClassLevel=document.getElementById("class-options").value
        let Gender=document.getElementById("gender-options").value
        let FirstName=document.getElementById("firstName").value
        let LastName=document.getElementById("lastName").value
 

        const data={
        SchoolCode,
        ClassLevel,
        Gender,
        FirstName,
        LastName,
        }
        return data
        }

        function addNewHeadTeacher(){
                const formData =formValue();
              //  console.log(formData)
                    $.ajax({
                        type: 'POST',
                        url: '{!! route('apiAddStudents') !!}',
                        headers: {
                        'Authorization': 'Bearer ' + token
                        
                        },
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            console.log(response)
                            window.location.reload()
                        },
        
                    });
                    //window.location.reload()
                }
        })

function getAllStudent(){
    const schools=document.getElementById("student-section-table")
    $.ajax({
        type: 'GET',
        url: '{!! route('getAllStudent') !!}',
        headers: {
            'Authorization': 'Bearer ' + token,
            "Content-Type":"application/json"
             },
        dataType: 'json',
        success: function(response) {

            const data=response;
            let i=0;
            data.forEach((response)=>{
           
           i++
            const table1=`
            <tr>
                <td class="whitespace-nowrap px-6 py-4">${i}</td>
                <td class="whitespace-nowrap px-6 py-4">${response.SchoolCode}</td>
                <td class="whitespace-nowrap px-6 py-4">${response.StudentCode}</td>
                <td class="whitespace-nowrap px-6 py-4">${response.SchoolClass}</td>
                <td class="whitespace-nowrap px-6 py-4">${response.FirstName}</td>
                <td class="whitespace-nowrap px-6 py-4">${response.LastName}</td>
                <td class="whitespace-nowrap px-6 py-4">${response.Gender}</td>
                <td class="whitespace-nowrap px-6 py-4"><button class="btn btn-primary">Edit</button></td>
                <td class="whitespace-nowrap px-6 py-4"><button class="btn btn-danger">Delete</button></td>
            </tr>
            `

           schools.insertAdjacentHTML("beforeend",table1);
          
        })
        
        },
        error: function(xhr, status, error) {
            // Handle errors if needed
            console.error(error);
        }
    });
}
</script>
@endsection


