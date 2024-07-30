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
    <div  class="w-full flex justify-center items-center mt-[50px] shadow-sm rounded-lg  py-5 px-10 border-l-2 border-slate-400" >
        <div class="w-1/2 font-serif font-medium text-[16px]  px-10" >
             <h3 class="py-2 border-b-2 border-red-900 my-4 w-[200px] border-dashed " id="table-title">Teacher Name</h3>
             <div id="student_name" class="w-full ">Emmanuel munezero</div>
        </div>

      
        <div class="w-1/2 flex flex-col  text-[16px] text-right" >
            <div class="py-2 font-semibold" >
                <label>Gender:</label>
                <span id="student_gender">Female</span>
            </div>
             <div class="py-1 font-semibold" >
                    <label>Section:</label>
                    <span id="student_class">---</span>
                </div>
            </div> 
    </div>
 
    <div class="w-full flex flex-col justify-center items-center mt-[50px] shadow-md rounded-lg border-l-2 border-slate-400 px-20" >
       
        <h3 class="py-2 border-b-2 border-red-900 my-4 w-full  font-extralight text-[20px]" id="table-title">
         {{ __("Student attendance Detail") }}
        </h3>       
                        <table class="w-full  rounded-sm border-collapse border border-slate-400 mx-11 mb-10"  id="student-section-table">
                            <tr>
                                <td rowspan="2" class="px-6 py-2">No</td>
                                <td class="px-6 py-2"> Date</td>
                                <td class="px-6 py-2"> Attendance</td>
                                <td class="px-6 py-2"> Teacher Comment</td>
                            </tr>
                        </table>
            </div>
        </div>
    </div>
    
    <!-- submit button ----------------------------------------- -->
</div>

<script>
const token=localStorage.getItem('auth_token');
const fullUrl = window.location.href;

function getIdFromCurrentUrl() {
    const pathname = window.location.pathname;
    const parts = pathname.split('/');
    return parts[parts.length - 1];
}

const id = getIdFromCurrentUrl();

 $(document).ready(function() {
    getAllStudent()
     
 })


function getAllStudent(){
    const studentList=document.getElementById("student-section-table")
    const teacherAttendanceDetailUrl = `/api/teacherAttendanceDetail/${id}`;
    $.ajax({
        type: 'GET',
        url: teacherAttendanceDetailUrl,
        headers: {
            'Authorization': 'Bearer ' + token
             },
        dataType: 'json',
        success: function(response) {
            document.getElementById("student_name").innerHTML=response[0].firstName +" "+response[0].lastName;
            document.getElementById("student_gender").innerHTML=response[0].Gender;
            document.getElementById("student_class").innerHTML=response[0].levels;
            const data=response;
            console.log("----------------------------------------",response)
            let i=0;
            data.forEach((response)=>{
           
           i++
            let table1=''
           if(response.status ==='Absent'){
            table1=`
            <tr class="bg-red-50">
                <td class="px-4 py-2" id="report-expected-men-nusery">${i}</td>
                <td class="px-4 py-2" >${response.attendedDay}</td>
                <td class="px-4 py-2">${response.status}</td>
                <td class="px-4 py-2">${response.comments}</td>
            </tr>
            `
           }else{
            table1=`
            <tr>
                <td class="px-4 py-2">${i}</td>
                <td class="px-4 py-2">${response.attendedDay}</td>
                <td class="px-4 py-2">${response.status}</td>
                <td class="px-4 py-2">${response.comments}</td>
            </tr>
            `
           }
            studentList.insertAdjacentHTML("beforeend",table1);
          
        })
        
        },
        error: function(xhr, status, error) {
            // Handle errors if needed
            console.error(error);
        }
    });
}


function todayDate(){
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0'); 
    const day = String(today.getDate()).padStart(2, '0');
    const formattedDate = `${year}-${month}-${day}`;
    return formattedDate
}



</script>
@endsection


