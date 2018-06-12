$(document).ready(function () {
  var max_fields = 30; //maximum input boxes allowed
  var wrapper = $(".input_fields_wrap"); //Fields wrapper
  var add_button = $(".add_field_button"); //Add button ID
  var mainWrapper=$("#mainwrapper")

  var x = 1; //initlal text box count

  var fields = '<div class="row new_row"><div class="col-sm-3 pr-1"><div class="form-group"><label>size</label><input type="text" class="form-control" name="size[]"></div></div><div class="col-sm-3 px-1"><div class="form-group"><label>color</label><input type="color" class="form-control" name="color[]"></div></div><div class="col-sm-3"><div class="form-group"><label>quantity</label><input type="number" class="form-control" name="quantity[]"></div></div><a href="#" class="remove_field" style="color: red; margin-top: 40px;">Remove</a></div>';
  $(add_button).click(function (e) { //on add input button click
    e.preventDefault();
    if (x < max_fields) { //max input box allowed
      x++; //text box increment
    
     // $(wrapper).append(fields) //add input box
    
    $(fields).appendTo(mainWrapper);
    }
  });

  $(mainWrapper).on("click", ".remove_field", function (e) { //user click on remove text
    e.preventDefault(); $(this).parent('div').remove(); x--;
  });

  $('#myCheck').on('change', function () {
    if ($(this).is(':checked')) {
      $('#dateField').show();
    } else {
      $('#dateField').hide();
    }
  });


});