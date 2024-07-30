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
            <div class="container"  style="padding-left:20px;padding-right:20px;margin:auto">
                        <div class="flex w-full">
                         <table class=" display rounded-sm border-collapse border border-slate-400 py-40" id="example" style="width:100%" >
                           <thead>
                            <tr class="border border-slate-700">
                                <th rowspan="2" class="px-6 py-2 border border-slate-300">No</th>
                                <th rowspan="2" class="px-6 py-2 border border-slate-300"> School Code</th>
                                <th  rowspan="2" class="px-6 py-2 border border-slate-300"> School Name</th>
                                <th  rowspan="2" class="px-6 py-2 border border-slate-300"> Student Code</th>
                                <th rowspan="2" class="px-6 py-2 border border-slate-300"> Class Level</th>
                                <th  rowspan="2" class="px-6 py-2 border border-slate-300"> FirstName</th>
                                <th  rowspan="2" class="px-6 py-2 border border-slate-100">LastName</th>
                                <th  rowspan="2" class="px-6 py-2 border border-slate-300">Gender</th>
                                <th colspan="5" class="px-6 py-2 border border-slate-300">Attendance Statistic</th>
                            </tr>
                            <tr class="border border-slate-700">
                                <th class="px-6 py-2 border border-slate-300"> Total</th>
                                <th class="px-6 py-2 border border-slate-300">Present </th>
                                <th class="px-6 py-2 border border-slate-300">Absent</th>
                                <th class="px-6 py-2 border border-slate-300">%</th>
                                <th class="px-6 py-2 border border-slate-300">Action</th>
                            </tr></thead><tbody id="student-section-table" ></tbody>
                         </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
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
    const schools=document.getElementById("student-section-table")
    const studentapi=`/api/SEO_AllStudentsByScool/${id}`
    //var table = new DataTable('#dynamic-table');
    $.ajax({
        type: 'GET',
        url:'{!! route('SEO_AllStudents') !!}',
        headers: {
            'Authorization': 'Bearer ' + token,
            "Content-Type":"application/json"
             },
        dataType: 'json',
        success: function(response) {
            console.log("ttttttttttttttttttttttttttttttttttttttt",response)
            const data=response;
            let i=0;
            data.forEach((response)=>{
            
                const attendanceResult=Number(Math.round(response.totalPresent*100/response.totalRegistered))
                const studentAttendanceDetailUrl = `/SEO-studentAttendancedetail/${response.id}`;
            
           i++
           let table1=''
           if(attendanceResult < 50){
           
             table1=`
            <tr style="background:#F9CB75" text-[#e20d0d77]">
                <td class="px-6 py-2 border border-slate-300">${i}</td>
                <td class="px-6 py-2 border border-slate-300">${response.SchoolCode}</td>
                <td class="px-6 py-2 border border-slate-300">${response.SchoolName}</td>
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
                <td class="px-6 py-2 border border-slate-300">${response.SchoolCode}</td>
                <td class="px-6 py-2 border border-slate-300">${response.SchoolName}</td>
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
           //table.row.add($(table1)).draw(false);
        })
        dataTable()
        },
        error: function(xhr, status, error) {
            // Handle errors if needed
            console.error(error);
        }
    });
}

function dataTable(){
   return  new DataTable('#example', {
    columnDefs: [
        {
            targets: [0],
            orderData: [0, 1]
        },
        {
            targets: [1],
            orderData: [1, 0]
        },
        {
            targets: [4],
            orderData: [4, 0]
        }
    ]
});
}
</script>
@endsection


