@extends('layouts.seolayout')

@section('content')
<style>
.count-input {
    background: yellow;
    display: flex;
    flex-direction: row;
    align-content: center;
    justify-content: space-around
}

.count-input div {
    width: 100px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-around
}
.display tbody tr:nth-child(odd) {
        background-color:#F8FDFD  ;
    }


</style>
<div class="flex flex-col p-4">
    <h3 class="pb-4  mb-6 w-full border-b-2 border-red-900 font-bold text-[20px]" id="reportHeader"> </h3>
    <div class="flex w-2/3 py-5 rounded-sm mb-3  mx-auto items-center">
        
        <label class="w-[40px] font-bold text-[18px]">From:</label>
        <input type="date" name="fromDate" id="fromDate" class="w-1/3 mx-3 rounded-lg " />
         <label class="w-[40px] font-bold text-[18px]">to:</label>
         <input type="date"  name="toDate" id="toDate" placeholder="from" class="w-1/3 mx-3 rounded-lg "/>              
        <button type="button" class="w-[170px] text-[#ffff] text-1xl font-medium bg-blue-900 h-10" id="check_date"> check report</button>
    </div>
   
    
    <div class="flex gap-4">
        <div class="flex flex-col rounded-md shadow-lg p-4 w-1/2">
            <h3 class="py-2  my-4 w-full  font-extralight text-[20px]" id="table-title">
                {{ __("Student attendance Detail in Nusery") }}
            </h3>
            <div id="nusery-section">
            <table   class=" display w-[100%] rounded-sm border-collapse border border-slate-400 text-center mx-auto">
                    <thead>
                        <tr class="border border-slate-300">
                            <th colspan="5" class="px-2 py-2 border border-slate-300">Total Registered</th>
                            <th colspan="4" class="px-2 py-2 border border-slate-300">Total Attended</th>
                        </tr>
                        <tr class="border border-slate-300">
                            <th hclass="px-2 py-2 border border-slate-300">No</th>
                            <th class="px-2 py-2 border border-slate-300">class</th>
                            <th class="px-2 py-2 border border-slate-300">Total</th>
                            <th class="px-2 py-2 border border-slate-300">Male</th>
                            <th class="px-2 py-2 border border-slate-300">Female</th>
                            <th class="px-2 py-2 border border-slate-300">Total</th>
                            <th class="px-2 py-2 border border-slate-300">Female</th>
                            <th class="px-2 py-2 border border-slate-300">Male</th>
                            <th class="px-2 py-2 border border-slate-300">%</th>
                        </tr>
                    </thead>

                    <tbody class="" id="nusery-section-table">
                        
                    </tbody>
                </table>
            </div>
        </div>
        <!---- primary school attendance code start here --------------------------------------------------------------------------- -->
        <div class="flex flex-col rounded-md shadow-lg p-4 w-1/2">
            <h3 class="py-2  my-4 w-full  font-extralight text-[20px]">
                {{ __("Student attendance Detail in Primary") }}
            </h3>
            <div class="overflow-x-auto" id="primary-section">
                <table   class=" display w-[100%] rounded-sm border-collapse border border-slate-400 text-center mx-auto">
                    <thead>
                        <tr class="border border-slate-300">
                            <th colspan="5" class="px-2 py-2 border border-slate-300">Total Registered</th>
                            <th colspan="4" class="px-2 py-2 border border-slate-300">Total Attended</th>
                        </tr>
                        <tr class="border border-slate-300">
                            <th class="px-2 py-2 border border-slate-300">No</th>
                            <th class="px-2 py-2 border border-slate-300">class</th>
                            <th class="px-2 py-2 border border-slate-300">Total</th>
                            <th class="px-2 py-2 border border-slate-300">Male</th>
                            <th class="px-2 py-2 border border-slate-300">Female</th>
                            <th class="px-2 py-2 border border-slate-300">Total</th>
                            <th class="px-2 py-2 border border-slate-300">Female</th>
                            <th class="px-2 py-2 border border-slate-300">Male</tdh>
                            <th class="px-2 py-2 border border-slate-300">%</th>
                        </tr>
                    </thead>

                    <tbody class="" id="primary-section-table">
                    </tbody>
                </table>
            </div>
        </div>
        `
    </div>

    <!---- attendance list for secondary and TVET ---------------------------------------------------------------------------- -->
    <!--- secondary school attendance start here ------------------------------------------>
    <div class="flex gap-4 mt-6">
        <div class="flex flex-col rounded-md shadow-lg p-4 w-1/2">
            <h3 class="py-2  my-4 w-full  font-extralight text-[20px]">
                {{ __("Student attendance Detail in Secondary") }}
            </h3>
            <div class="overflow-x-auto" id="secondary-section">
                <table class=" display w-[92%] rounded-sm border-collapse border border-slate-400 text-center mx-auto" id="example2">
                    <thead>
                        <tr class="border border-slate-300">
                            <th colspan="5" class="px-2 py-2 border border-slate-300">Total Registered</th>
                            <th colspan="4" class="px-2 py-2 border border-slate-300">Total Attended</th>
                        </tr>
                        <tr class="border border-slate-300">
                            <th class="px-2 py-2 border border-slate-300">No</th>
                            <th class="px-2 py-2 border border-slate-300">class</th>
                            <th class="px-2 py-2 border border-slate-300">Total</th>
                            <th class="px-2 py-2 border border-slate-300">Male</th>
                            <th class="px-2 py-2 border border-slate-300">Female</th>
                            <th class="px-2 py-2 border border-slate-300">Total</th>
                            <th class="px-2 py-2 border border-slate-300">Female</th>
                            <th class="px-2 py-2 border border-slate-300">Male</th>
                            <th class="px-2 py-2 border border-slate-300">%</th>
                        </tr>
                    </thead>

                    <tbody class="" id="secondary-section-table">
                    </tbody>
                </table>
            </div>
        </div>
        <!---- TVET school attendance code start here --------------------------------------------------------------------------- -->
        <div class="flex flex-col rounded-md shadow-lg p-4 w-1/2">
            <h3 class="py-2  my-4 w-full  font-extralight text-[20px]">
                {{ __("Student attendance Detail in TVET ") }}
            </h3>
            <div class="overflow-x-auto" id="tvet-section">
                <table id="example3" class=" display w-[92%] rounded-sm border-collapse border border-slate-400 text-center mx-auto">
                    <thead>
                        <tr class="border border-slate-300">
                            <th colspan="5" class="px-2 py-2 border border-slate-300">Total Registered</th>
                            <th colspan="4" class="px-2 py-2 border border-slate-300">Total Attended</th>
                        </tr>
                        <tr class="border border-slate-300">
                            <th class="px-2 py-2 border border-slate-300">No</th>
                            <th class="px-2 py-2 border border-slate-300">class</th>
                            <th class="px-2 py-2 border border-slate-300">Total</th>
                            <th class="px-2 py-2 border border-slate-300">Male</th>
                            <th class="px-2 py-2 border border-slate-300">Female</th>
                            <th class="px-2 py-2 border border-slate-300">Total</th>
                            <th class="px-2 py-2 border border-slate-300">Female</th>
                            <th class="px-2 py-2 border border-slate-300">Male</th>
                            <th class="px-2 py-2 border border-slate-300">%</th>
                        </tr>
                    </thead>
                    <tbody class="" id="tvet-section-table">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>











<script>

function getIdFromCurrentUrl() {
    const pathname = window.location.pathname;
    const parts = pathname.split('/');
    return parts[parts.length - 1];
}

const sectorCode = getIdFromCurrentUrl();
$(document).ready(function() {
   
    const token = localStorage.getItem('auth_token');
    getStudentReportData()

    $("#check_date").click(function(){
        getStudentReportData()
    })
  
    //formValue()
    $("#submitReport").click(function() {
        saveData()
    })




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
        const nuseryReport = document.getElementById("nusery-section-table")
        const primaryReport = document.getElementById("primary-section-table")
        const secondaryReport = document.getElementById("secondary-section-table")
        const tvetReport = document.getElementById("tvet-section-table")

        while (nuseryReport.firstChild) {
            nuseryReport.removeChild(nuseryReport.firstChild);
           
        }

        while (primaryReport.firstChild) {
            primaryReport.removeChild(primaryReport.firstChild);
        }
        while (secondaryReport.firstChild) {
            secondaryReport.removeChild(secondaryReport.firstChild);

        }
        // while (tvetReport.firstChild) {
        //     tvetReport.removeChild(tvetReport.firstChild);
        // }
}


    function getStudentReportData() {
        destroy()
       removeAllRows()
        const nuseryReport = document.getElementById("nusery-section-table")
        const primaryReport = document.getElementById("primary-section-table")
        const secondaryReport = document.getElementById("secondary-section-table")
        const tvetReport = document.getElementById("tvet-section-table")
        // simce it a daily report we check a report for single day and that why from date is the same as to date because I don't want to change backend logic
       // let  fromDate=document.getElementById("fromDate").value;
        let  fromDate=document.getElementById("fromDate").value;
        let  toDate=document.getElementById("toDate").value;

         //const studentAttendanceBySector = `/api/DEO_StudentAttendance`

        let formData={}
        if(fromDate!=='' && toDate!==''){
                formData={
                    fromDate,
                    toDate,
                    sectorCode
                }
            }else{
                formData={
                fromDate:todayDate(),
                toDate:todayDate(),
                sectorCode
            }
        }
        document.getElementById("reportHeader").innerText="School attendance report statistic from "+formData.fromDate +" to "+formData.toDate
        $.ajax({
            type: 'GET',
            url:'{!! route('seosectorstudentattendance') !!}',
            headers: {
                'Authorization': 'Bearer ' + token
            },
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log("++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++",response)
                const data = response;
                let i = 0;
                data.forEach((response) => {


                   
                    i++

                    if (response.levels == 'Nusery') {
                        const attendance = response.studentsAttendance

                        let a = 0;
                        let totalRegistered = 0
                        let totalRegisteredMale = 0
                        let totalRegisteredFemale = 0
                        let totalAttended = 0
                        let totalAttendedMale = 0
                        let totalAttendedFemale = 0
                        let totalPercentage = 0

                        if (attendance.length < 1) {
                            document.getElementById("nusery-section-table").innerHTML =
                                `<tr><td colspan="9">Attendance is not yet done</td></tr>`
                        } else {
                            attendance.forEach(element => {
                                a++

                                totalRegistered += Number(element.totalRegistered)
                                totalRegisteredMale += Number(element.totalMale)
                                totalRegisteredFemale += Number(element.totalFemale)
                                totalAttended += Number(element.totalPresent)
                                 totalAttendedMale += Number(element
                                    .totalPresentMale)
                                totalAttendedFemale += Number(element
                                    .totalPresentMale)

                                if (element.totalPresent >= element
                                    .totalRegistered / 2) {
                                    const table1 = `
                            <tr>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${a}</td>
                                 <td class="px-2 py-2 border border-b-2 border-slate-300 "><a class="cursor-pointer text-red-600" href='/SectorStudentAttendanceDetail?date=${element.attendedDay}'>${element.attendedDay}</a></td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalRegistered}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresent}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresentFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresentMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${(element.totalPresent*100/element.totalRegistered).toFixed(2)}</td>
                            </tr>
                            `
                                    nuseryReport.insertAdjacentHTML("beforeend",
                                        table1)
                                } else {
                                    const table1 = `
                            <tr style="background:#F9CB75">
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${a}</td>
                                 <td class="px-2 py-2 border border-b-2 border-slate-300 "><a class="cursor-pointer text-red-600" href='/SectorStudentAttendanceDetail?date=${element.attendedDay}'>${element.attendedDay}</a></td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalRegistered}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresent}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresentFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresentMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${(element.totalPresent*100/element.totalRegistered).toFixed(2)}</td>
                            </tr>
                            `
                                    nuseryReport.insertAdjacentHTML("beforeend",
                                        table1)
                                }
                            })

                        }
                       // dataTable()
                    }
                    // primary section ---------------------------------------------------------
                    if (response.levels == 'Primary') {
                        const attendance = response.studentsAttendance
                        let a = 0;
                        let totalRegistered = 0
                        let totalRegisteredMale = 0
                        let totalRegisteredFemale = 0
                        let totalAttended = 0
                        let totalAttendedMale = 0
                        let totalAttendedFemale = 0
                        let totalPercentage = 0

                        if (attendance.length < 1) {
                            document.getElementById("primary-section-table").innerHTML =
                                `<tr><td colspan="9">Attendance is not yet done</td></tr>`
                        } else {
                            attendance.forEach(element => {
                                a++

                                totalRegistered += Number(element.totalRegistered)
                                totalRegisteredMale += Number(element.totalMale)
                                totalRegisteredFemale += Number(element.totalFemale)
                                totalAttended += Number(element.totalPresent)
                                totalAttendedMale += Number(element
                                    .totalPresentMale)
                                totalAttendedFemale += Number(element
                                    .totalPresentMale)

                                if (element.totalPresent >= element
                                    .totalRegistered / 2) {
                                    const table1 = `
                            <tr>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${a}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300 "><a class="cursor-pointer text-red-600" href='/SectorStudentAttendanceDetail?date=${element.attendedDay}'>${element.attendedDay}</a></td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalRegistered}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresent}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresentFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresentMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${(element.totalPresent*100/element.totalRegistered).toFixed(2)}</td>
                            </tr>
                            `
                                    primaryReport.insertAdjacentHTML("beforeend",
                                        table1)
                                } else {
                                    const table1 = `
                            <tr style="background:#F9CB75">
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${a}</td>
                                 <td class="px-2 py-2 border border-b-2 border-slate-300 "><a class="cursor-pointer text-red-600" href='/SectorStudentAttendanceDetail?date=${element.attendedDay}'>${element.attendedDay}</a></td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalRegistered}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresent}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresentFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresentMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${(element.totalPresent*100/element.totalRegistered).toFixed(2)}</td>
                            </tr>
                            `
                                    primaryReport.insertAdjacentHTML("beforeend",
                                        table1)
                                }
                            })
                           
                    
                        }
                        //dataTable1()
                    }
                    // secondary section ---------------------------------------------------------

                    if (response.levels == 'Secondary') {
                        const attendance = response.studentsAttendance

                        let a = 0;
                        let totalRegistered = 0
                        let totalRegisteredMale = 0
                        let totalRegisteredFemale = 0
                        let totalAttended = 0
                        let totalAttendedMale = 0
                        let totalAttendedFemale = 0
                        let totalPercentage = 0

                        if (attendance.length < 1) {
                            document.getElementById("secondary-section-table").innerHTML =
                                `<tr><td colspan="9">Attendance is not yet done</td></tr>`
                        } else {
                            attendance.forEach(element => {
                                a++

                                totalRegistered += Number(element.totalRegistered)
                                totalRegisteredMale += Number(element.totalMale)
                                totalRegisteredFemale += Number(element.totalFemale)
                                totalAttended += Number(element.totalPresent)
                                totalAttendedMale += Number(element
                                    .totalPresentMale)
                                totalAttendedFemale += Number(element
                                    .totalPresentMale)

                                if (element.totalPresent >= element
                                    .totalRegistered / 2) {
                                    const table1 = `
                            <tr>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${a}</td>
                                 <td class="px-2 py-2 border border-b-2 border-slate-300 "><a class="cursor-pointer text-red-600" href='/SectorStudentAttendanceDetail?date=${element.attendedDay}'>${element.attendedDay}</a></td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalRegistered}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresent}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresentFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresentMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${(element.totalPresent*100/element.totalRegistered).toFixed(2)}</td>
                            </tr>
                            `
                                    secondaryReport.insertAdjacentHTML("beforeend",
                                        table1)
                                } else {
                                    const table1 = `
                            <tr style="background:#F9CB75">
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${a}</td>
                                 <td class="px-2 py-2 border border-b-2 border-slate-300 "><a class="cursor-pointer text-red-600" href='/SectorStudentAttendanceDetail?date=${element.attendedDay}'>${element.attendedDay}</a></td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalRegistered}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresent}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresentFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresentMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${(element.totalPresent*100/element.totalRegistered).toFixed(2)}</td>
                            </tr>
                            `
                                    secondaryReport.insertAdjacentHTML("beforeend",
                                        table1)
                                }
                            })
                           

                        }
                       // dataTable2()
                    }
                    // TVET section ---------------------------------------------------------
                    if (response.levels == 'TVET') {
                        const attendance = response.studentsAttendance

                        let a = 0;
                        let totalRegistered = 0
                        let totalRegisteredMale = 0
                        let totalRegisteredFemale = 0
                        let totalAttended = 0
                        let totalAttendedMale = 0
                        let totalAttendedFemale = 0
                        let totalPercentage = 0

                        if (attendance.length < 1) {
                            document.getElementById("secondary-section-table").innerHTML =
                                `<tr><td colspan="9">Attendance is not yet done</td></tr>`
                        } else {
                            attendance.forEach(element => {
                                a++

                                totalRegistered += Number(element.totalRegistered)
                                totalRegisteredMale += Number(element.totalMale)
                                totalRegisteredFemale += Number(element.totalFemale)
                                totalAttended += Number(element.totalPresent)
                                totalAttendedMale += Number(element
                                    .totalPresentMale)
                                totalAttendedFemale += Number(element
                                    .totalPresentMale)

                                if (element.totalPresent >= element
                                    .totalRegistered / 2) {
                                    const table1 = `
                            <tr>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${a}</td>
                                 <td class="px-2 py-2 border border-b-2 border-slate-300 "><a class="cursor-pointer text-red-600" href='/SectorStudentAttendanceDetail?date=${element.attendedDay}'>${element.attendedDay}</a></td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalRegistered}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresent}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresentFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresentMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${(element.totalPresent*100/element.totalRegistered).toFixed(2)}</td>
                            </tr>
                            `
                                    tvetReport.insertAdjacentHTML("beforeend",
                                        table1)
                                } else {
                                    const table1 = `
                            <tr style="background:#F9CB75">
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${a}</td>
                                 <td class="px-2 py-2 border border-b-2 border-slate-300 "><a class="cursor-pointer text-red-600" href='/SectorStudentAttendanceDetail?date=${element.attendedDay}'>${element.attendedDay}</a></td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalRegistered}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresent}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresentFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresentMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${(element.totalPresent*100/element.totalRegistered).toFixed(2)}</td>
                            </tr>
                            `
                                    tvetReport.insertAdjacentHTML("beforeend",
                                        table1)
                                }
                            })
                           


                        }
                    }
                    //dataTable3()
                })
                dataTable()
                // dataTable1()
                // dataTable2()
                // dataTable3()
            },

            error: function(xhr, status, error) {
                // Handle errors if needed
                console.error(error);
            }
        });
    }


})


function dataTable() {
        return new DataTable('.display', {
             "pagingType": "full_numbers"
           // destroy: true,
        });

}

function destroy(){
    if($.fn.DataTable.isDataTable('.display')) {
    $('.display').DataTable().destroy();
}
$('.display tbody').empty();
}

</script>
@endsection