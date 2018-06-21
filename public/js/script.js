$(function(){
$('#selected_find').change(() => {
    let find_value = $('#selected_find').val();
    switch (find_value) {
      case "day":
        $('#dynamic_find').html(``)
        break;
      case "date":
        $('#dynamic_find').html(`
          <label class="control-label col-lg-12 text-left" > ยอดขาย ณ วันที่ (เดือน/วัน/ปี)</label>
            <div class="col-lg-12" id="find-day">
                <input type="text" value="" name="saledate" id="saledate" class="form-control">
                <br>
           </div>
           <script>
           $('#find-day input').datepicker({
             format: "dd/mm/yyyy",
             todayBtn: "linked",
             language: "th",
             toggleActive: true
           });
           </script>
        `)
        break;
      case "month":
        $('#dynamic_find').html(`
            <div class="col-lg-8" style="margin-bottom:20px">
            <label class="control-label col-lg-8 text-left" > ยอดขาย ณ เดือน</label>
              ${month()}
            </div>
             <div class="col-lg-4" style="margin-bottom:20px">
              <label class="control-label col-lg-4 text-left" > ปี</label>
             <select class="form-control" name="year" id="year">
             </select>
            </div>
        `)
        year(document.getElementById("year"))
        break;
      case "year":
        $('#dynamic_find').html(`
          <div class="col-lg-12" style="margin-bottom:20px">
           <label class="control-label col-lg-4 text-left" > ปี</label>
          <select class="form-control" name="year" id="year">
          </select>
         </div>
        `)
        year(document.getElementById("year"))
        break;
      case "7day":
        $('#dynamic_find').html(``)
        break;
      case "one_month":
        $('#dynamic_find').html(``)
        break;
      case "three_month":
        $('#dynamic_find').html(``)
        break;
      case "one_year":
         $('#dynamic_find').html(``)
        break;
      case "custom":
        $('#dynamic_find').html(`
            <div class="col-lg-6" id="from_date">
            <label class="control-label col-lg-12 text-left"> ยอดขายจากวันที่ (เดือน/วัน/ปี)</label>
                <input type="text" value="" name="fromdate" id="fromdate" class="form-control">
                <br>
           </div>
             <div class="col-lg-6" id="to_date">
              <label class="control-label col-lg-12 text-left" > ถึงวันที่ (เดือน/วัน/ปี)</label>
                 <input type="text" value="" name="todate" id="todate" class="form-control">
                 <br>
            </div>
           <script>
           $('#from_date input').datepicker({
             format: "dd/mm/yyyy",
             todayBtn: "linked",
             language: "th",
             toggleActive: true
           });
           $('#to_date input').datepicker({
             format: "dd/mm/yyyy",
             todayBtn: "linked",
             language: "th",
             toggleActive: true
           });
           </script>
        `)
        break;
      default:

    }
})
});


function month() {
    let months = `<select class="form-control" name="month">
                  <option value="1">มกราคม</option>
                  <option value="2">กุมภาพันธ์</option>
                  <option value="3">มีนาคม</option>
                  <option value="4">เมษายน</option>
                  <option value="5">พฤษภ่คม</option>
                  <option value="6">มิถุนายน</option>
                  <option value="7">กรกฎาคม</option>
                  <option value="8">สิงหาคม</option>
                  <option value="9">กันยายน</option>
                  <option value="10">ตุลาคม</option>
                  <option value="11">พฤศจิกายน</option>
                  <option value="12">ธันวาคม</option>
                  </select>`;
      return months;
}

function year(selector) {
  let yeartoday = new Date().getFullYear();
  for (let i = yeartoday; i > yeartoday - 10; i--) {
    $(selector).append('<option value="' + i + '">' + i + '</option>');
  }
}

function goBack() {
    window.history.back();
}
