@extends('layouts.seolayout')

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
                  Assign school to Head Teacher
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
                <form class="space-y-4" action="#" id="assignSchoolForm">
                     <div id="userId-sesction"></div>
                   <div>
                        <label for="sector-options" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sector</label>
                        <select type="text" name="sector"  id="sector-options"
                         class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" 
                            >
                         <option>Select Sector</option>
                    </select>
                    </div>
                    <div>
                        <label for="school-options" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">School</label>
                        <select type="text" name="sector"  id="school-options"
                         class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" 
                            >
                         <option>Select School</option>
                    </select>
                    </div>
                    <button type="button" id="addHeadTeacher-button"
                     class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add School</button>
                </form>
            </div>
        </div>
    </div>
</div> 






                        <div class="w-full flex flex-col justify-center items-center mt-[50px]">
                            <table class="min-w-full text-left text-sm font-light text-surface dark:text-white" >
                            <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                                <tr>
                                    <td rowspan="2" class="px-6 py-4">No</td>
                                    <td rowspan="2" class="px-6 py-4">Date of Registration</td>
                                    <td class="px-6 py-4"> Name</td>
                                    <td class="px-6 py-4">email</td>
                                    <td class="px-6 py-4">telephone</td>
                                    <td class="px-6 py-4">School Code</td>
                                    <td class="px-6 py-4">School Name</td>
                                    <td colspan="3" class="px-6 py-4 text-center">Actions</td>
                                </tr>
                            </thead>
                            <tbody id="teacher-section-table">
                            </tbody>
                            </table>
                        </div>
                  
<script>
const token = localStorage.getItem('auth_token');
 $(document).ready(function() {
       getSectorInfo()
      getAllHeadTeacher()
    $("#addHeadTeacher-button").click(function(){
        addNewHeadTeacher()
    })

    $("#sector-options").change(function(){
        getAllSchool()
    })

    $(".assign-button").click(function(){
        getAllSchool()
    })

function getSectorInfo(){
    const sector=document.getElementById("sector-options")
    $.ajax({
        type: 'GET',
        url: '{!! route('getAllSectors') !!}',
        headers: {
            'Authorization': 'Bearer ' + token
            
             },
        dataType: 'json',
        success: function(response) {
            const data=response;
            console.log("hhhhh",data)
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
                <Option value="${response.id}">${response.SchoolName}</Option>
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

function getAllHeadTeacher(){

    const schoolTeachers=document.getElementById("teacher-section-table")
    $.ajax({
        type: 'GET',
        url: '{!! route('apiGetAllSchoolDOS') !!}',
        headers: {
            'Authorization': 'Bearer ' + token,
             },
        dataType: 'json',
        success: function(response) {
        const data=response; 
        console.log("--------------------",data)  
        let b=0;
        data.forEach((elem)=>{
        b++
        const table=`
            <tr class="border-b border-neutral-200 dark:border-white/10">
                <td class="whitespace-nowrap px-6 py-4 teacher-list-${elem.id}" >${b}</td>
                <td class="whitespace-nowrap px-6 py-4 teacher-list-${elem.id}">${elem.created_at.split("T")[0]}</td>
                <td class="whitespace-nowrap px-6 py-4 teacher-list-${elem.id}">${elem.firstName} ${elem.lastName}</td>
                <td class="whitespace-nowrap px-6 py-4 teacher-list-${elem.id}">${elem.email}</td>
                <td class="whitespace-nowrap px-6 py-4 teacher-list-${elem.id}">${elem.Telephone}</td>
                <td class="whitespace-nowrap px-6 py-4 teacher-list-${elem.id}">${elem.SchoolCode}</td>
                <td class="whitespace-nowrap px-6 py-4 teacher-list-${elem.id}">${elem.SchoolName}</td>
                <td class="whitespace-nowrap px-6 py-4 teacher-list-${elem.id}">
                <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" onclick="assignClaasToTeacher(${elem.id})" id="save_${elem.id}"
                class="block bg-gray-800 float-end text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" 
                type="button">
                 Assign School
                </button>
                <td class="whitespace-nowrap px-6 py-4 teacher-list-${elem.id}"><button id="edit_${elem.id}" class="btn btn-primary" onclick="assignClaasToTeacher(${elem.id})">Edit </button></td>
                <td class="whitespace-nowrap px-6 py-4 teacher-list-${elem.id}"><button id="delete_${elem.id}" class="btn btn-danger" onclick="assignClaasToTeacher(${elem.id})">Delete</button></td>
            </tr>`
            schoolTeachers.insertAdjacentHTML("beforeend",table);
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
    
        let schoolId=document.getElementById("school-options").value
        let userId=document.getElementById("userId").value
        // let position=document.getElementById("position-options").value
        // let SectorCode=document.getElementById("sector-options").value
        // let LastName=document.getElementById("lastName").value
        // let email=document.getElementById("email").value
        // let telephone=document.getElementById("telephone").value

        const data={
        schoolId,
        userId
        }
        return data
        }

        function addNewHeadTeacher(){
                const formData =formValue();
               console.log(formData)
                    $.ajax({
                        type: 'POST',
                        url: '{!! route('apischoolStaffList') !!}',
                        headers: {
                        'Authorization': 'Bearer ' + token,
                        "Content-Type":"application/json"
                        },
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            console.log("+++++++++++++++++++++++",response)
                          //  window.location.reload()
                        },
                        error: function(xhr, status, error) {
                            // Handle errors if needed
                            console.error(error);
                        }
                    });
                    //window.location.reload()
                }
        })

function assignClaasToTeacher(id){
    var form_container = document.getElementById("userId-sesction");
    var input = document.createElement("input");
        input.type = "text";
        input.name = "userId";
        input.value=`${id}`;
        input.id="userId";
        input.hidden="hidden";
        form_container.appendChild(input);
       
}
</script>
@endsection


