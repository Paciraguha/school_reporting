@extends('layouts.app')

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
<div  style="padding-left:20px;padding-right:20px;margin-right:50px;margin:auto">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="width:100%;">

                <div class="card-header">{{ __("UBWITABIRE BW'ABANYESHURI") }}</div>
                <div class="card-body">

                <div class="row">
                <div class="col-md-12" id="get-nusery-section-report">
                 UBWITABIRE BW'ABANYESHURI Y'INCUKE 
                    <div class="nussery-report-section">
                        <table class="table" id="nussery-report-section-table">
                            <tr>
                                <td rowspan="2">No</td>
                                <td rowspan="2">Date of Report</td>
                                <td colspan="3"> ABANYESHURI BATEGANYIJWE KWITABIRA (N1,N2&N3)</td>
                                <td colspan="4">ABANYESHURI BITABIRIYE (N1,N2&N3)</td>
                            </tr>
                            <tr>
                                <td id="report-expected-men-nusery">Abagabo</td>
                                <td id="report-expected-women-nusery">Abagore</td>
                                <td id="report-expected-total-nusery">Bose</td>
                                <td id="report-attended-men-nusery">Abagabo</td>
                                <td id="report-attended-women-nusery">Abagore</td>
                                <td id="report-attended-total-nusery">Bose</td>
                                <td id="report-expected-percentage-nusery">%</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-12" id="get-primary-section-report">
                 UBWITABIRE BW'ABANYESHURI ABANZA 
                    <div class="primary-report-section">
                    <table class="table" id="primary-report-section-table">
                            <tr>
                                <td rowspan="2">No</td>
                                <td rowspan="2">Date of Report</td>
                                <td colspan="3"> ABANYESHURI BATEGANYIJWE KWITABIRA  MURI P1-P6</td>
                                <td colspan="4">ABANYESHURI BITABIRIYE MURI P1-P6</td>
                            </tr>
                            <tr>
                                <td id="report-expected-men-primary">Abagabo</td>
                                <td id="report-expected-women-primary">Abagore</td>
                                <td id="report-expected-total-primary">Bose</td>
                                <td id="report-attended-men-primary">Abagabo</td>
                                <td id="report-attended-women-primary">Abagore</td>
                                <td id="report-attended-total-primary">Bose</td>
                                <td id="report-expected-percentage-primary">%</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-12" id="get-alevel-section-report">
                 UBWITABIRE BW'ABANYESHURI YISUMBUYE 
                    <div class="primary-report-section">
                    <table class="table" id="level-report-section-table">
                            <tr>
                                <td rowspan="2">No</td>
                                <td rowspan="2">Date of Report</td>
                                <td colspan="3">  ABANYESHURI BATEGANYIJWE KWITABIRA  MURI  SECONDAIRE BOSE (S1-S6)</td>
                                <td colspan="4">ABANYESHURI BITABIRIYE MURI SECONDAIRE BOSE (S1-S6)</td>
                            </tr>
                            <tr>
                                <td id="report-expected-men-level">Abagabo</td>
                                <td id="report-expected-women-level">Abagore</td>
                                <td id="report-expected-total-level">Bose</td>
                                <td id="report-attended-men-level">Abagabo</td>
                                <td id="report-attended-women-level">Abagore</td>
                                <td id="report-attended-total-level">Bose</td>
                                <td id="report-expected-percentage-level">%</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-12" id="get-tvet-section-report">
                UBWITABIRE BW'ABANYESHURI MURI TVET
                    <div class="primary-report-section">
                    <table class="table" id="tvet-report-section-table">
                            <tr>
                                <td rowspan="2">No</td>
                                <td rowspan="2">Date of Report</td>
                                <td colspan="3"> ABANYESHURI  BATEGANYIJWE KWITABIRA MURI TVET BOSE ( L1-L5)</td>
                                <td colspan="4">ABANYESHURI BITABIRIYE  MURI TVET BOSE (L1-L5)</td>
                            </tr>
                            <tr>
                                <td id="report-expected-men-tvet">Abagabo</td>
                                <td id="report-expected-women-tvet">Abagore</td>
                                <td id="report-expected-total-tvet">Bose</td>
                                <td id="report-attended-men-tvet">Abagabo</td>
                                <td id="report-attended-women-tvet">Abagore</td>
                                <td id="report-attended-total-tvet">Bose</td>
                                <td id="report-expected-percentage-tvet">%</td>
                            </tr>
                        </table>
                    </div>
                </div>
                </div>




                <div class="row">
                <div class="col-md-12" id="nusery-section">
                    UBWITABIRE BW'ABANYESHURI Y'INCUKE 
                    <div class="row">
                        <div class="col-md-6">
                            ABANYESHURI BATEGANYIJWE KWITABIRA (N1,N2&N3)
                            <div class="row count-input">
                              <div>
                                <label>Abagabo</label>
                                <div> <input id="expectedGirl" name="expectedGirl" type="text" class="form-control"  value="10"  autofocus readonly></div>
                              </div>
                             <div>
                                <label>Abagore</label>
                                <div><input id="expectedBoy" name="expectedBoy" type="text" class="form-control" value="20"  autofocus readonly></div>
                             </div>
                                
                            <div>
                                <label>Bose</label>
                                <div><input id="expectedTotal" name="expectedTotal" type="text" class="form-control"  value=""  autofocus readonly></div>
                            </div>
                                
                            </div>
                        </div>
                        <div class="col-md-6">ABANYESHURI BITABIRIYE (N1,N2&N3)

                            <div class="row count-input">
                                <div><label>Abagabo</label></label>
                                <div> <input id="attendedGirl" name="attendedGirl" type="text" class="form-control"  value=""  autofocus ></div>
                                </div>
                                <div><label>Abagore</label>
                                <div><input id="attendedBoy" name="attendedBoy" type="text" class="form-control" value=""  autofocus ></div>
                                </div>
                                <div><label>Bose</label>
                                <div><input id="attendedTotal" name="attendedTotal" type="text" class="form-control"  value=""  autofocus readonly></div>
                                </div>
                                <div><label>%</label>
                                <div><input id="attendedPercentage" name="attendedPercentage" type="text" class="form-control" value=""  autofocus readOlny></div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div> 
                <div class="col-md-12"> 
                UBWITABIRE BW'ABANYESHURI ABANZA
                  <div class="row">
                      <div class="col-md-6">
                        ABANYESHURI BATEGANYIJWE KWITABIRA  MURI P1-P6
                            <div class="row count-input">
                              <div>
                                <label>Abagabo</label>
                                <div> <input id="primaryExpectedGirl" name="primaryExpectedGirl" type="text" class="form-control"  value="10"  autofocus readonly></div>
                              </div>
                             <div>
                                <label>Abagore</label>
                                <div><input id="primaryExpectedBoy" name="primaryExpectedBoy" type="text" class="form-control" value="20"  autofocus readonly></div>
                             </div>
                                
                            <div>
                                <label>Bose</label>
                                <div><input id="primaryExpectedTotal" name="primaryExpectedTotal" type="text" class="form-control"  value=""  autofocus readonly></div>
                            </div>
                                
                            </div>
                        </div>
                        <div class="col-md-6">ABANYESHURI BITABIRIYE MURI P1-P6

                            <div class="row count-input">
                                <div><label>Abagabo</label></label>
                                <div> <input id="primaryAttendedGirl" name="primaryAttendedGirl" type="text" class="form-control"  value=""  autofocus ></div>
                                </div>
                                <div><label>Abagore</label>
                                <div><input id="primaryAttendedBoy" name="primaryAttendedBoy" type="text" class="form-control" value=""  autofocus ></div>
                                </div>
                                <div><label>Bose</label>
                                <div><input id="primaryAttendedTotal" name="primaryAttendedTotal" type="text" class="form-control"  value=""  autofocus readonly></div>
                                </div>
                                <div><label>%</label>
                                <div><input id="primaryAttendedPercentage" name="primaryAttendedPercentage" type="text" class="form-control" value=""  autofocus readOlny></div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div> 
                <div class="col-md-12">
                    UBWITABIRE BW'ABANYESHURI YISUMBUYE 
                 <div class="row">
                    <div class="col-md-6">
                      ABANYESHURI BATEGANYIJWE KWITABIRA  MURI  SECONDAIRE BOSE (S1-S6)
                        <div class="row count-input">
                            <div>
                                <label>Abagabo</label>
                                <div> <input id="levelExpectedGirl" name="levelExpectedGirl" type="text" class="form-control"  value="10"  autofocus readonly></div>
                            </div>
                            <div>
                                <label>Abagore</label>
                                <div><input id="levelExpectedBoy" name="levelExpectedBoy" type="text" class="form-control" value="20"  autofocus readonly></div>
                            </div>  
                            <div>
                                <label>Bose</label>
                                <div><input id="levelExpectedTotal" name="levelExpectedTotal" type="text" class="form-control"  value=""  autofocus readonly></div>
                            </div> 
                         </div>
                      </div>
                    <div class="col-md-6">
                    ABANYESHURI BITABIRIYE MURI SECONDAIRE BOSE (S1-S6)
                       <div class="row count-input">
                            <div><label>Abagabo</label></label>
                            <div> <input id="levelAttendedGirl" name="levelAttendedGirl" type="text" class="form-control"  value=""  autofocus ></div>
                            </div>
                            <div><label>Abagore</label>
                            <div><input id="levelAttendedBoy" name="levelAttendedBoy" type="text" class="form-control" value=""  autofocus ></div>
                            </div>
                            <div><label>Bose</label>
                            <div><input id="levelAttendedTotal" name="levelAttendedTotal" type="text" class="form-control"  value=""  autofocus readonly></div>
                            </div>
                            <div><label>%</label>
                            <div><input id="levelAttendedPercentage" name="levelAttendedPercentage" type="text" class="form-control" value=""  autofocus readOnly>
                        </div>
                      </div>
                    </div>
                    </div>
                   </div>
                </div> 
                <div class="col-md-12">UBWITABIRE BW'ABANYESHURI MURI TVET 
                    <div class="row">
                        <div class="col-md-6">
                        ABANYESHURI  BATEGANYIJWE KWITABIRA MURI TVET BOSE ( L1-L5)
                            <div class="row count-input">
                            <div>
                                <label>Abagabo</label>
                                <div> <input id="tvetExpectedGirl" name="tvetExpectedGirl" type="text" class="form-control"  value="10"  autofocus readonly></div>
                            </div>
                            <div>
                                <label>Abagore</label>
                                <div><input id="tvetExpectedBoy" name="tvetExpectedBoy" type="text" class="form-control" value="20"  autofocus readonly></div>
                            </div>
                                
                            <div>
                                <label>Bose</label>
                                <div><input id="tvetExpectedTotal" name="tvetExpectedTotal" type="text" class="form-control"  value=""  autofocus readonly></div>
                            </div>
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                        ABANYESHURI BITABIRIYE  MURI TVET BOSE (L1-L5)

                            <div class="row count-input">
                                <div><label>Abagabo</label></label>
                                <div> <input id="tvetAttendedGirl" name="tvetAttendedGirl" type="text" class="form-control"  value=""  autofocus ></div>
                                </div>
                                <div><label>Abagore</label>
                                <div><input id="tvetAttendedBoy" name="tvetAttendedBoy" type="text" class="form-control" value=""  autofocus ></div>
                                </div>
                                <div><label>Bose</label>
                                <div><input id="tvetAttendedTotal" name="tvetAttendedTotal" type="text" class="form-control"  value=""  autofocus readonly></div>
                                </div>
                                <div><label>%</label>
                                <div><input id="tvetAttendedPercentage" name="tvetAttendedPercentage" type="text" class="form-control" value=""  autofocus readOlny></div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <!-- submit button ----------------------------------------- -->
    <div class="row">
    <button  id="submitReport">Add Report</button>
    </div>
</div>

<script>
 $(document).ready(function() {
    
    getStudentReportData()
    formValue()
    $("#submitReport").click(function(){
        saveData()
    })

function getStudentReportData(){
    const nuseryReport=document.getElementById("nussery-report-section-table")
    const primaryReport=document.getElementById("primary-report-section-table")
    const secondaryReport=document.getElementById("level-report-section-table")
    const tvetReport=document.getElementById("tvet-report-section-table")
    $.ajax({
        type: 'GET',
        url: '{!! route('getStudentsReport') !!}',
        dataType: 'json',
        success: function(response) {
            console.log(response)
            const data=response;
            let i=0;
            data.forEach((response)=>{
           
           i++
            const table1=`
            <tr>
                <td id="report-expected-men-nusery">${i}</td>
                <td id="report-expected-men-nusery">${response.created_at}</td>
                <td id="report-expected-men-nusery">${response.NurseryExpectedBoy}</td>
                <td id="report-expected-women-nusery">${response.NurseryExpectedGirl}</td>
                <td id="report-expected-total-nusery">${response.NurseryExpectedTotal}</td>
                <td id="report-attended-men-nusery">${response.NurseryAttendedBoy}</td>
                <td id="report-attended-women-nusery">${response.NurseryAttendedGirl}</td>
                <td id="report-attended-total-nusery">${response.NurseryAttendedTotal}</td>
                <td id="report-expected-percentage-nusery">${response.NurseryPercentage}</td>
            </tr>
            `

            nuseryReport.insertAdjacentHTML("beforeend",table1);
            const table2=`
            <tr>
                <td id="report-expected-men-nusery">${i}</td>
                <td id="report-expected-men-nusery">${response.created_at}</td>
                <td id="report-expected-men-primary">${response.PrimaryExpectedBoy}</td>
                <td id="report-expected-women-nusery">${response.PrimaryExpectedGirl}</td>
                <td id="report-expected-total-nusery">${response.PrimaryExpectedTotal}</td>
                <td id="report-attended-men-nusery">${response.PrimaryAttendedBoy}</td>
                <td id="report-attended-women-nusery">${response.PrimaryAttendedGirl}</td>
                <td id="report-attended-total-nusery">${response.PrimaryAttendedTotal}</td>
                <td id="report-expected-percentage-nusery">${response.PrimaryPercentage}</td>
            </tr>
            `
            primaryReport.insertAdjacentHTML("beforeend",table2);

            const table3=`
            <tr>
                <td id="report-expected-men-nusery">${i}</td>
                <td id="report-expected-men-nusery">${response.created_at}</td>
                <td id="report-expected-men-primary">${response.OlevelExpectedBoy}</td>
                <td id="report-expected-women-nusery">${response.OlevelExpectedGirl}</td>
                <td id="report-expected-total-nusery">${response.OlevelExpectedTotal}</td>
                <td id="report-attended-men-nusery">${response.OlevelAttendedBoy}</td>
                <td id="report-attended-women-nusery">${response.OlevelAttendedGirl}</td>
                <td id="report-attended-total-nusery">${response.OlevelAttendedTotal}</td>
                <td id="report-expected-percentage-nusery">${response.OlevelPercentage}</td>
            </tr>
            `
            secondaryReport.insertAdjacentHTML("beforeend",table3);

            const table4=`
            <tr>
                <td id="report-expected-men-nusery">${i}</td>
                <td id="report-expected-men-nusery">${response.created_at}</td>
                <td id="report-expected-men-primary">${response.AlevelExpectedBoy}</td>
                <td id="report-expected-women-nusery">${response.AlevelExpectedGirl}</td>
                <td id="report-expected-total-nusery">${response.AlevelExpectedTotal}</td>
                <td id="report-attended-men-nusery">${response.AlevelAttendedBoy}</td>
                <td id="report-attended-women-nusery">${response.AlevelAttendedGirl}</td>
                <td id="report-attended-total-nusery">${response.AlevelAttendedTotal}</td>
                <td id="report-expected-percentage-nusery">${response.AlevelPercentage}</td>
            </tr>
            `
            tvetReport.insertAdjacentHTML("beforeend",table4);
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
let expectedGirl=document.getElementById("expectedGirl").value
let expectedBoy = document.getElementById("expectedBoy").value
let attendedGirl = document.getElementById("attendedGirl").value
let attendedBoy = document.getElementById("attendedBoy").value

let expectedTotal = Number(expectedGirl)+Number(expectedBoy)
let attendedTotal = Number(attendedGirl)+Number(attendedBoy)

let attendedPercentage =attendedTotal*100/expectedTotal


document.getElementById("expectedTotal").value=expectedTotal
document.getElementById("attendedTotal").value=attendedTotal
document.getElementById("attendedPercentage").value=attendedPercentage 
// primary ---------------------------------------------------------------------------------------------------
let primaryExpectedGirl=document.getElementById("primaryExpectedGirl").value
let primaryExpectedBoy = document.getElementById("primaryExpectedBoy").value
let primaryAttendedGirl = document.getElementById("primaryAttendedGirl").value
let primaryAttendedBoy = document.getElementById("primaryAttendedBoy").value

let primaryExpectedTotal = Number(primaryExpectedGirl)+Number(primaryExpectedBoy)
let primaryAttendedTotal = Number(primaryAttendedGirl)+Number(primaryAttendedBoy)

let primaryAttendedPercentage =primaryAttendedTotal*100/primaryExpectedTotal


document.getElementById("primaryExpectedTotal").value=primaryExpectedTotal
document.getElementById("primaryAttendedTotal").value=primaryAttendedTotal
document.getElementById("primaryAttendedPercentage").value=primaryAttendedPercentage 


//Alevel calculation ----------------------------------------------------------------------------

const levelExpectedGirl=document.getElementById("levelExpectedGirl").value
let levelExpectedBoy = document.getElementById("levelExpectedBoy").value
let levelAttendedGirl = document.getElementById("levelAttendedGirl").value
let levelAttendedBoy = document.getElementById("levelAttendedBoy").value

let levelExpectedTotal = Number(levelExpectedGirl)+Number(levelExpectedBoy)
let levelAttendedTotal = Number(levelAttendedGirl)+Number(levelAttendedBoy)

let levelAttendedPercentage =levelAttendedTotal*100/levelExpectedTotal


document.getElementById("levelExpectedTotal").value=levelExpectedTotal
document.getElementById("levelAttendedTotal").value=levelAttendedTotal
document.getElementById("levelAttendedPercentage").value=levelAttendedPercentage 

// tvet calculation -------------------------------------------------------------------------------
const tvetExpectedGirl=document.getElementById("tvetExpectedGirl").value
let tvetExpectedBoy = document.getElementById("tvetExpectedBoy").value
let tvetAttendedGirl = document.getElementById("tvetAttendedGirl").value
let tvetAttendedBoy = document.getElementById("tvetAttendedBoy").value

let tvetExpectedTotal = Number(tvetExpectedGirl)+Number(tvetExpectedBoy)
let tvetAttendedTotal = Number(tvetAttendedGirl)+Number(tvetAttendedBoy)

let tvetAttendedPercentage =tvetAttendedTotal*100/tvetExpectedTotal

document.getElementById("tvetExpectedTotal").value=tvetExpectedTotal
document.getElementById("tvetAttendedTotal").value=tvetAttendedTotal
document.getElementById("tvetAttendedPercentage").value=tvetAttendedPercentage 
const nusery={
    NurseryExpectedBoy:expectedBoy,
    NurseryExpectedGirl:expectedGirl,
    NurseryExpectedTotal:expectedTotal,
    NurseryAttendedBoy: attendedBoy ,
    NurseryAttendedGirl:attendedGirl,
    NurseryAttendedTotal:attendedTotal,
    NurseryPercentage:attendedPercentage,
}

const Primary={
    PrimaryExpectedBoy:primaryExpectedBoy,
    PrimaryExpectedGirl:primaryExpectedGirl,
    PrimaryExpectedTotal:primaryExpectedTotal,
    PrimaryAttendedBoy:primaryAttendedBoy,
    PrimaryAttendedGirl:primaryAttendedGirl,
    PrimaryAttendedTotal:primaryAttendedTotal,
    PrimaryPercentage:primaryAttendedPercentage,
}
const Olevel={
    OlevelExpectedBoy:levelExpectedBoy,
    OlevelExpectedGirl:levelExpectedGirl,
    OlevelExpectedTotal:levelExpectedTotal,
    OlevelAttendedBoy:levelAttendedBoy,
    OlevelAttendedGirl:levelAttendedGirl ,
    OlevelAttendedTotal:levelAttendedTotal,
    OlevelPercentage:levelAttendedPercentage,
};
const Alevel={
      
    AlevelExpectedBoy:tvetExpectedBoy,
    AlevelExpectedGirl:tvetExpectedGirl,
    AlevelExpectedTotal:tvetAttendedGirl,
    AlevelAttendedBoy:tvetAttendedBoy,
    AlevelAttendedGirl:tvetAttendedGirl,
    AlevelAttendedTotal:tvetAttendedTotal,
    AlevelPercentage:tvetAttendedPercentage 
}
const data={
    nusery,
    Primary,
    Olevel,
    Alevel
}
return data
}




function saveData(){

    

            // Serialize the form data
           const formData =formValue();
            // Send an AJAX request
            $.ajax({
                type: 'POST',
                url: '{!! route('addStudentsReport') !!}',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    window.location.reload()
                    console.log("------------------------------------",response);
                },
                error: function(xhr, status, error) {
                    // Handle errors if needed
                    console.error(error);
                }
            });
        }
})


</script>
@endsection


