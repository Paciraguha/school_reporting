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
<div class="container mx-auto"  style="margin:auto">

<div id="authentication-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-1/3">
        <div class="p-4 border-b">
             <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3  id="modal-title" class="text-xl font-semibold text-gray-900 dark:text-white">
                  Assign school to Head Teacher
                </h3>
                <button type="button"  onclick="closeModal()" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
        </div>
        <div class="p-4">
            <p id="modal-content">
            </p>
            <div class="p-4 md:p-5">
            <form class="space-y-4" action="#" id="assignSchoolForm">
                <div id="userId-sesction"></div>
               <div class ="flex gap-2"> 
                <div class="mb-2 w-1/2">
                    <label for="school code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">school code</label>
                    <input type="text" id="schoolcode" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pacifique" name="lastname"  />
                </div>
                <div class="mb-2 w-1/2">
                    <label for="schoolname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">school code</label>
                    <input type="text" id="schoolname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pacifique" name="lastname"  />
                </div>
              </div>
              <div class ="flex gap-2"> 
                <div class="mb-2 w-1/2">
                <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First name</label>
                <input type="text" id="firstname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Iraguha" name="firstname"  />
                </div>
                <div class="mb-2 w-1/2">
                    <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last name</label>
                    <input type="text" id="lastname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pacifique" name="lastname"  />
                </div>
                
            </div>
            <div class ="flex gap-2"> 
                <div class="mb-2 w-1/2">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" name="email"  />
                </div>
                <div class="mb-2 w-1/2">
                    <label for="telephone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telephone</label>
                    <input type="text" id="telephone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0787031933" name="telephone"  />
                </div>
             </div>
             <div class ="flex gap-2">
             <div class="mb-2 w-1/2">
                    <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
                <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="gender" name="gender"   required>
                          
                </select>

                </div> 
                <div class="mb-2 w-1/2">
                    <label for="position" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Position</label>
                     <select  onchange="teacherPosition(this.value)" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="position" name="position"  autocomplete="position"  required> 
                    </select>
                </div>
                </div>
                <div class="flex gap-2">
                <div  class="mb-2 w-1/2">
                    <label for="sector-options" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sector</label>
                    <select type="text" name="sector"  id="sector-options"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" 
                    required >
                    <option disabled>Select Sector</option>
                </select>
                </div>
                <div  class="mb-2 w-1/2">
                    <label for="school-options" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">School</label>
                    <select type="text" name="school"  id="school-options"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" 
                    onchange="schoolLevels(this.value)" required  >
                    <option disabled>Select School</option>
                    </select>
                </div>
                <div  class="mb-2 w-1/2" id="levelsofschool" >
                    <label for="school-level" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">levels</label>
                    <select type="text" name="school"  id="school-level"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" 
                      required  >
                      <Option  value="0">Select level</Option>
                    </select>
                </div>
            </div>
            </form>
            </div>
        </div class="w-full flex" >
            <div class="p-4 border-t text-left">
            <button type="button" id="addHeadTeacher-button"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
            </div>
        </div>
        <div>
       
    </div>
</div>


<div class="w-full flex flex-col justify-center items-center mt-[50px] overflow-x-auto" >
<div class="w-full flex justify-between">
<div class=" w-full md:w-1/3 flex flex-col justify-evenly">
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select various list of staff</label>
    <select id="filterData" class="bg-gray-50 border border-gray-900 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
        <option value="HeadTeacher"> Head Teachers</option>
        <option value="DOS"> DOS</option>
        <option value="Teacher">Teachers</option>
    </select>
</div>
<a href="{{route('newStaff')}}" type="button" id="Teacher" 
    class="showData w-[150px] h-10 text-white  bg-gray-800 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    Add new Staff
</a>

</div>

<h3 class="py-2 border-b-2 border-red-900 my-4 w-full" id="table-title">
    {{ __("Schools in districts") }}
</h3>
<table id="displayTable" class="display min-w-full w-full text-left text-sm font-light text-surface dark:text-white" >
<thead class="border-b border-neutral-200 font-medium dark:border-white/10">
    <tr>
        <th  class="px-3 py-2">No</th>
        <th  class="px-3 py-2">Date of Registration</th>
        <th class="px-3 py-2"> Name</th>
        <th class="px-3 py-2">email</th>
        <td class="px-3 py-2">telephone</th>
        <th class="px-3 py-2">Gender</th>
        <th class="px-3 py-2">Position</th>
        <th class="px-3 py-2">School Code</th>
        <th class="px-3 py-2">School Name</th>
        <th class="px-3 py-2">Levels</th>
        <th class="px-3 py-2 text-center">Actions</th>
    </tr>
</thead>
<tbody id="teacher-section-table">
</tbody>
</table>
</div>
                  
<script>
const token = localStorage.getItem('auth_token');
document.getElementById("levelsofschool").style.display = "none";
var filterData={"HeadTeacher":"HeadTeacher"}

 $(document).ready(function() {
      
      getAllHeadTeacher(filterData)
    $("#addHeadTeacher-button").click(function(){
        addNewHeadTeacher()
    })

    $("#sector-options").change(function(){
        getAllSchool()
    })

    // $(".assign-button").click(function(){
    //     getAllSchool()
    // })

    $('#filterData').change(function() { 
        destroy()
     const trElement=document.querySelectorAll(".tr-data")
     console.log("ggggggg",trElement.length)
     trElement.forEach(element => {
        element.remove()
     });
    
    //alert($(this).val())
     filterData={"HeadTeacher": $(this).val()};
    getAllHeadTeacher(filterData)
});

})


function teacherPosition(position) {
            if (position === "Teacher") {
                document.getElementById("levelsofschool").style.display = "block";
            } else {
                document.getElementById("levelsofschool").style.display = "none"; 
            }
        }

 function schoolLevels(SchoolId){
  
    const schoolLevel=document.getElementById("school-level")
    let url=""
    if(SchoolId.position){
        url=`/api/SchoolLevel/${SchoolId.school_id}`
    }else{
        url=`/api/SchoolLevel/${SchoolId}`
    }
      
  console.log("////////////////////////////////////////////",SchoolId)
    schoolLevel.innerHTML="";

    const options=`
                <Option value="0">select levels</Option>
            `
            schoolLevel.insertAdjacentHTML("beforeend",options);
    
    $.ajax({
        type: 'GET',
        url: url,
        headers: {
            'Authorization': 'Bearer ' + token,
             },
        dataType: 'json',
        success: function(response) {
            const data=response;
            console.log("ffffffffffffffffffffffffffffff",data)
            let i=0;
            data.forEach((response)=>{
           i++
            const options=`
                <Option ${SchoolId.school_id && SchoolId.teachingLevel==response.id?"selected":""}  value="${response.id}">${response.levels}</Option>
            `
            schoolLevel.insertAdjacentHTML("beforeend",options);
          
        })
        },
        error: function(xhr, status, error) {
            // Handle errors if needed
            console.error(error);
        }
    });
 }


function getSectorInfo(user){
    const sector=document.getElementById("sector-options")
    sector.innerHTML="";
    console.log("+++++++++++++++++++++++++++++++++++++",user)
    $.ajax({
        type: 'GET',
        url: '{!! route('getAllSectors') !!}',
        headers: {
            'Authorization': 'Bearer ' + token,
             },
        dataType: 'json',
        success: function(response) {
            const data=response;
            console.log("hhhhh",data)
            let i=0;
            data.forEach((response)=>{
           
           i++
            const options=`
                <Option ${user.SectorCode===response.SectorCode?"selected":""} value="${response.SectorCode}">${response.SectorName}</Option>
            `
           sector.insertAdjacentHTML("beforeend",options);
          
        })
        getAllSchool()
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
    const schoolcode=document.getElementById('schoolcode').value;


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
                <Option  ${schoolcode===response.SchoolCode?"selected":""} value="${response.id}">${response.SchoolName}</Option>
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

function getAllHeadTeacher(id){
    document.getElementById("table-title").innerText=`List of  ${id.HeadTeacher} in districts`;
    const schoolTeachers=document.getElementById("teacher-section-table")
    $.ajax({
        type: 'GET',
        url: '{!! route('apiGetAllSchoolHeadTeachers') !!}',
        headers: {
            'Authorization': 'Bearer ' + token,
            "Content-Type":"application/json"
             },
        data:filterData,
        dataType: 'json',
        success: function(response) {
        const data=response; 
        console.log("hhhhhhhhh",data)  
        let b=0;
        data.forEach((elem)=>{
        b++
        const table = `
        <tr class="border-b border-neutral-200 dark:border-white/10 tr-data">
            <td class="whitespace-nowrap px-3 py-2 teacher-list-${elem.id}">${b}</td>
            <td class="whitespace-nowrap px-3 py-2 teacher-list-${elem.id}">${elem.created_at.split("T")[0]}</td>
            <td class="whitespace-nowrap px-3 py-2 teacher-list-${elem.id}">${elem.firstName} ${elem.lastName}</td>
            <td class="whitespace-nowrap px-3 py-2 teacher-list-${elem.id}">${elem.email}</td>
            <td class="whitespace-nowrap px-3 py-2 teacher-list-${elem.id}">${elem.Telephone}</td>
            <td class="whitespace-nowrap px-3 py-2 teacher-list-${elem.id}">${elem.Gender}</td>
            <td class="whitespace-nowrap px-3 py-2 teacher-list-${elem.id}">${elem.position}</td>
            <td class="whitespace-nowrap px-3 py-2 teacher-list-${elem.id}">${elem.SchoolCode}</td>
            <td class="whitespace-nowrap px-3 py-2 teacher-list-${elem.id}">${elem.SchoolName}</td>
             <td class="whitespace-nowrap px-3 py-2 teacher-list-${elem.id}">${elem.teachingLevel==0?"---":elem.levels}</td>
            <td class="whitespace-nowrap px-3 py-2"> 
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                more action
                </button>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start z-3 w-[150px]">
                ${elem.position === "Teacher" ? `
                    <li>
                    <a href="/addSchool?sectorcode=${response.SectorCode}" class="dropdown-item" style="display:flex;flex-direction:cols">
                        <img src="{{asset('assets/images/reorder-four-outline.svg')}}" class="w-[40px] px-2"/>Attendance
                    </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                ` : ''}
                <li>
                    <a onclick='openModal(${JSON.stringify(elem)})' class="dropdown-item" href="#" data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" style="display:flex;flex-direction:cols">
                    <img src="{{asset('assets/images/icons8-edit-26.png')}}" class="w-[35px] px-2"/>Edit
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a onClick='deleteSector(${response.SectorId})' class="dropdown-item" style="display:flex;flex-direction:cols">
                    <img src="{{asset('assets/images/trash-outline.svg')}}" class="w-[40px] px-2 text-white"/>Delete
                    </a>
                </li>
                </ul>
            </div>
            </td>
        </tr>`;

            schoolTeachers.insertAdjacentHTML("beforeend",table);
        }) 
        dataTable()
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
        let schoolcode= document.getElementById('schoolcode').value
     
        let lastName= document.getElementById('lastname').value;
        let firstName=document.getElementById('firstname').value;
        let email=document.getElementById('email').value;
        let telephone=document.getElementById('telephone').value;
        let gender=document.getElementById('gender').value;
        let position=document.getElementById('position').value
        let schoolLevel=document.getElementById('school-level').value
        const data={
        schoolId,
        userId,
        firstName,
        lastName,
        email,
        telephone,
        gender,
        position,
        schoolLevel

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
                        'Authorization': 'Bearer ' + token
                        },
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            console.log(response)
                            alert(response.message)
                           window.location.reload()
                        },
                        error: function(xhr, status, error) {
                            // Handle errors if needed
                           
                           alert(xhr.responseJSON.message);
                        }
                    });
                    //window.location.reload()
                }
       



function openModal(user) {
   console.log("--------------------------------",user)
   getSectorInfo(user)
    var form_container = document.getElementById("userId-sesction");
    var input = document.createElement("input");
        input.type = "text";
        input.name = "userId";
        input.value=`${user.id}`;
        input.id="userId";
        input.hidden="true";
        form_container.appendChild(input);


    document.getElementById('schoolcode').value=user.SchoolCode;
    document.getElementById('schoolname').value=user.SchoolName;
    document.getElementById('lastname').value=user.lastName;
    document.getElementById('firstname').value=user.firstName;
    document.getElementById('email').value=user.email;
    document.getElementById('telephone').value=user.Telephone;
    document.getElementById('position').innerHTML="",

    document.getElementById('position').innerHTML=`
     <option value="" disabled>Select Position</option>
    <option ${user.position=="Teacher"?"selected":""} value="Teacher">Teacher</option>
    <option ${user.position=="HeadTeacher"?"selected":""} value="HeadTeacher">Head Teacher</option>
    <option ${user.position=="DOS"?"selected":""} value="DOS">DOS</option>
    `;

    document.getElementById('gender').innerHTML="";
    document.getElementById('gender').innerHTML=`
    <option value="" disabled>Select Gender</option>
    <option ${user.Gender=="Male"?"selected":""} value="Male">Male</option>
    <option ${user.Gender=="Female"?"selected":""} value="Female">Female</option>
    `;

         if(user.position === "Teacher") {
                document.getElementById("levelsofschool").style.display = "block";
                schoolLevels(user)
            } else {
                document.getElementById("levelsofschool").style.display = "none"; 
            }

    document.getElementById('modal-title').innerText = 'Assign School to ' + user.firstName;
    document.getElementById('modal-content').innerText = 'Editing details for ' +user.firstName;
    document.getElementById('authentication-modal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById("userId").remove();
    document.getElementById('authentication-modal').classList.add('hidden');
}


function dataTable() {
        return new DataTable('#displayTable', {
             "pagingType": "full_numbers"
           // destroy: true,
        });

}

function destroy(){
    if($.fn.DataTable.isDataTable('#displayTable')) {
    $('#displayTable').DataTable().destroy();
}
$('#displayTable tbody').empty();
}


</script>
@endsection


