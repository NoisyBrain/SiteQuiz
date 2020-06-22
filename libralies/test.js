var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("questao");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].classList.add('hidden');
      slides[i].classList.remove('show');
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].classList.add("show");
  slides[slideIndex-1].classList.remove('hidden');
  dots[slideIndex-1].className += " active";
} 
function resposta(id_question, alternativa, idAlternativas){
  new Ajax.Request( '../controllers/controllerAnswer.php', {
    method: 'get',
    parameters: {
      idQuestion: id_question,
      resposta: alternativa,
      idAlternativas: idAlternativas
    },
    onSuccess: resposta_sucesso,
    onFailure: resposta_failure
  });
}
function resposta_sucesso(response){
  var x = JSON.parse(response.responseText);
  var alternativas = document.getElementById(x['2']);
  var alternativa = alternativas.children[x[1]];
  if(x[0] == '1'){

    alternativa.style.backgroundColor="green";

  }else{

    alternativa.style.backgroundColor="red";

  }
}
function resposta_failure(response){
  response.Status;
}
