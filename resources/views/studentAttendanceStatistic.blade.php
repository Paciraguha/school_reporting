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
   
                        <div class="flex w-full py-5 shadow-lg rounded-sm mb-3 overflow-x-auto px-100 ">
                         <table class="w-full  rounded-sm border-collapse border border-slate-400 mx-11" id="student-section-table" >
                            <tr class="border border-slate-700">
                                <td rowspan="2" class="px-6 py-2 border border-slate-300">No</td>
                                <td  rowspan="2" class="px-6 py-2 border border-slate-300 text-[#530b]"> Student Code</td>
                                <td rowspan="2" class="px-6 py-2 border border-slate-300"> Class Level</td>
                                <td  rowspan="2" class="px-6 py-2 border border-slate-300"> FirstName</td>
                                <td  rowspan="2" class="px-6 py-2 border border-slate-100">LastName</td>
                                <td  rowspan="2" class="px-6 py-2 border border-slate-300">Gender</td>
                                <td colspan="5" class="px-6 py-2 border border-slate-300">Attendance Statistic</td>
                            </tr>
                            <tr class="border border-slate-700">
                                <td class="px-6 py-2 border border-slate-300"> Total</td>
                                <td class="px-6 py-2 border border-slate-300">Present </td>
                                <td class="px-6 py-2 border border-slate-300">Absent</td>
                                <td class="px-6 py-2 border border-slate-300">%</td>
                                <td class="px-6 py-2 border border-slate-300">Action</td>
                            </tr>
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

const token=localStorage.getItem('auth_token');
 $(document).ready(function() {
    getAllStudent()
    
 })

function getAllStudent(){
    const schools=document.getElementById("student-section-table")
   
    $.ajax({
        type: 'GET',
        url: '{!! route('getStudentsAttendanceScore') !!}',
        headers: {
            'Authorization': 'Bearer ' + token,
            "Content-Type":"application/json"
             },
        dataType: 'json',
        success: function(response) {

            const data=response;
            console.log("----------------------------------------",response)
            let i=0;
            data.forEach((response)=>{
            
                const attendanceResult=Number(Math.round(response.totalPresent*100/response.totalRegistered))

                const studentAttendanceDetailUrl = `/classAttendanceDetail/${response.id}`;
            
           i++
           let table1=''
           if(attendanceResult < 50){
           
             table1=`
            <tr class="bg-red-50 "text-[#e20d0d77]">
                <td class="px-6 py-2 border border-slate-300">${i}</td>
                <td class="px-6 py-2 border border-slate-300">${response.StudentCode}</td>
                <td class="px-6 py-2 border border-slate-300">${response.SchoolClass}</td>
                <td class="px-6 py-2 border border-slate-300">${response.FirstName}</td>
                <td class="px-6 py-2 border border-slate-300">${response.LastName}</td>
                <td class="px-6 py-2 border border-slate-300">${response.Gender}</td>
                <td class="px-6 py-2 border border-slate-300">${response.totalRegistered}</td>
                <td class="px-6 py-2 border border-slate-300">${response.totalPresent}</td>
                <td class="px-6 py-2 border border-slate-300">${response.totalAbsent}</td>
                <td class="px-6 py-2 border border-slate-300">${attendanceResult}%</td>
                <td class="px-6 py-2 border border-slate-300">
                <a href="${studentAttendanceDetailUrl}" class="btn btn-outline-danger btn-small"  id="present${response.id}">Detail</a></td>
            </tr>
            `
           }else{
    
             table1=`
            <tr> 
                <td class="px-6 py-2 border border-slate-300">${i}</td>
                <td class="px-6 py-2 border border-slate-300">${response.StudentCode}</td>
                <td class="px-6 py-2 border border-slate-300">${response.SchoolClass}</td>
                <td class="px-6 py-2 border border-slate-300">${response.FirstName}</td>
                <td class="px-6 py-2 border border-slate-300">${response.LastName}</td>
                <td class="px-6 py-2 border border-slate-300">${response.Gender}</td>
                <td class="px-6 py-2 border border-slate-300">${response.totalRegistered}</td>
                <td class="px-6 py-2 border border-slate-300">${response.totalPresent}</td>
                <td class="px-6 py-2 border border-slate-300">${response.totalAbsent}</td>
                <td class="px-6 py-2 border border-slate-300">${attendanceResult}%</td>
                <td class="px-6 py-2 border border-slate-300"><a href="${studentAttendanceDetailUrl}" class="btn btn-primary btn-small" id="present${response.id}">Detail</a></td>
            </tr>
            `
           
           }
         
           schools.insertAdjacentHTML("beforeend",table1);
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
    const month = String(today.getMonth() + 1).padStart(2, '0'); // Months are 0-based, so we add 1
    const day = String(today.getDate()).padStart(2, '0');
    const formattedDate = `${year}-${month}-${day}`;
    return formattedDate
}


</script>
@endsection


