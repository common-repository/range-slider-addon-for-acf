jQuery(document).ready(function($){

 var val1 = $("input[name$='[min]']").val()
 $("input[name$='[default_value_1]']").attr('min',val1)
 $("input[name$='[default_value_2]']").attr('min',val1)
 $("input[name$='[max]']").attr('min',val1)

 var val2 = $("input[name$='[max]']").val()
 $("input[name$='[default_value_1]']").attr('max',val2)
 $("input[name$='[default_value_2]']").attr('max',val2)
 $("input[name$='[min]']").attr('max',val2)

 $("input[name$='[default_value_1]']").on('input',function(){
  var val_df1 = $("input[name$='[default_value_1]']").val()
  $("input[name$='[default_value_1]']").attr('value',val_df1)
 })
 
 $("input[name$='[default_value_2]']").on('input',function(){
  var val_df2 = $("input[name$='[default_value_2]']").val()
  $("input[name$='[default_value_2]']").attr('value',val_df2)
 })

 $("input[name$='[min]']").on('input', function(){
  var val_min = $("input[name$='[min]']").val()
  $("input[name$='[min]']").attr('value',val_min)
  $("input[name$='[default_value_1]']").attr('min',val_min)
  $("input[name$='[default_value_2]']").attr('min',val_min)
  $("input[name$='[max]']").attr('min',val_min)
 })

 $("input[name$='[max]']").on('input', function(){
  var val_max = $("input[name$='[max]']").val()
  $("input[name$='[max]']").attr('value',val_max)
  $("input[name$='[default_value_1]']").attr('max',val_max)
  $("input[name$='[default_value_2]']").attr('max',val_max)
  $("input[name$='[min]']").attr('max',val_max)
 })
 $(".acf-publish").on('click', function(e){
  var max = parseFloat($("input[type='number']").attr('max'));                                     
  var min = parseFloat($("input[type='number']").attr('min'));
  var val_df1 = $("input[name$='[default_value_1]']").val()
  val_df1 = parseInt(val_df1)
  var val_df2 = $("input[name$='[default_value_2]']").val()
  val_df2 = parseInt(val_df2)
  if(val_df1>val_df2 && min > max) {
   e.preventDefault()
   alert("Please add correct values")
  }
  else if (val_df1>val_df2) {
   e.preventDefault()
   alert("Please add correct default values")
  }
  else if (min > max) {
   e.preventDefault()
   alert("Please add correct min-max values")
  }
 })
}) 