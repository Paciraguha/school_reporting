@extends('layouts.teacherlayout')

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
   
                       
                        
                        <div class="flex flex-col w-full py-5 shadow-lg rounded-sm mb-3 overflow-x-auto">
                        <div class="flex w-2/3 py-5 rounded-sm mb-3  mx-auto">
                            <input type="date" name="fromDate" id="fromDate" placeholder="from" class="w-1/3 mx-3 rounded-lg "/>
                            <input type="date" name="toDate" id="toDate" class="w-1/3 mx-3 rounded-lg "/>
                            <button type="button" class="w-[170px] text-[#ffff] text-1xl font-medium bg-blue-900" id="check_date"> check attendance</button>
                        </div>
                        <table class="w-[92%]  rounded-sm border-collapse border border-slate-400 mx-11" >
                        <thead>
                           <tr class="border border-slate-700">
                                <th colspan='5' class="px-6 py-2 border border-slate-300" > Total Student</td>
                                <th colspan='5' class="px-6 py-2 border border-slate-300">Attendance Detail </td>
                            </tr>
                            <tr class="border border-slate-700">
                                <th class="px-6 py-2 border border-slate-300">No</th>
                                <th class="px-6 py-2 border border-slate-300"> Date</th>
                                <th class="px-6 py-2 border border-slate-300"> Total</th>
                                <th class="px-6 py-2 border border-slate-300"> Male</th>
                                <th class="px-6 py-2 border border-slate-300">Female</th>
                                <th class="px-6 py-2 border border-slate-300">Attended Total</th>
                                <th class="px-6 py-2 border border-slate-300">Attended Male</th>
                                <th class="px-6 py-2 border border-slate-300">Attended Female</th>
                                <th class="px-6 py-2 border border-slate-300">Percentage</th>
                                <th class="px-6 py-2 border border-slate-300">Details</th>
                            </tr>
                        <thead>
                            <tbody id="student-section-table">

                            <tbody>
                    </table>
                    </div>
                   
  
</div>

<script>
 $(document).ready(function() {
    getAttendanceReport()
    $("#check_date").click(function(){
        getAttendanceReport()
    })
  

    $("#addHeadTeacher-button").click(function(){
        addNewHeadTeacher()
    })

   

})

const token = localStorage.getItem('auth_token');
console.log(token)

function todayDate(){
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0'); // Months are 0-based, so we add 1
    const day = String(today.getDate()).padStart(2, '0');
    const formattedDate = `${year}-${month}-${day}`;
    return formattedDate
}



    // Function to remove all rows within the tbody
    function removeAllRows() {
        const studentSectionTable = document.getElementById('student-section-table');
        // Remove all child nodes of the tbody
        while (studentSectionTable.firstChild) {
            studentSectionTable.removeChild(studentSectionTable.firstChild);
        }
    }




function getAttendanceReport(){
    removeAllRows()
    const schools=document.getElementById("student-section-table")
    let  fromDate=document.getElementById("fromDate").value;
    let  toDate=document.getElementById("toDate").value;
    let formData={}
    if(fromDate!=='' && toDate!==''){
            formData={
                fromDate,
                toDate
            }
        }else{
            formData={
            fromDate:todayDate(),
            toDate:todayDate()
        }
    }
    console.log("-------------------------------------",formData)
    $.ajax({
        type: 'GET',
        url: '{!! route('getStudentsAttendance') !!}',
        headers: {
            'Authorization': 'Bearer ' + token
             },
        data: formData,
        dataType: 'json',
        success: function(response) {
                console.log(response)
            const data=response;
            let i=0;
           data.forEach((response)=>{
           
            i++
            const table1=`
            <tr>
                <td class="whitespace-nowrap px-6 py-2 border border-slate-300">${i}</td>
                <td class="whitespace-nowrap px-6 py-2 border border-slate-300">${response.attendedDay}</td>
                <td class="whitespace-nowrap px-6 py-2 border border-slate-300">${response.totalRegistered}</td>
                <td class="whitespace-nowrap px-6 py-2 border border-slate-300">${response.totalMale}</td>
                <td class="whitespace-nowrap px-6 py-2 border border-slate-300">${response.totalFemale}</td>
                <td class="whitespace-nowrap px-6 py-2 border border-slate-300">${response.totalPresent}</td>
                <td class="whitespace-nowrap px-6 py-2 border border-slate-300">${response.totalPresentMale}</td>
                <td class="whitespace-nowrap px-6 py-2 border border-slate-300">${response.totalPresentFemale}</td>
                <td class="whitespace-nowrap px-6 py-2 border border-slate-300">${Math.floor(response.totalPresent*100/response.totalRegistered)} %</td>
                <td class="whitespace-nowrap px-6 py-2 border border-slate-300"><a class='btn btn-outline-primary' href='/classAttendance?attendance=${response.attendedDay}'>detail</a></td>
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


