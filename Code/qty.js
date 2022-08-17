//Done by Rahaf Alhajri
function quantity(){
  var link = document.getElementById('buy-link');
  var formEl = document.forms.prodForm;
  var formData = new FormData(formEl);
  var qty = formData.get('quantity');
  var url = link.getAttribute("href");
  link.href = url +'&quantity='+qty;
}
