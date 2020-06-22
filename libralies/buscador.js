function buscar(){
    ClearReasult();
    var palavra = document.getElementById('reaserch_bar').value;

    new Ajax.Request('../controllers/controllerbuscar.php', 
    {
      method: "get",
      parameters: {
          titulo: palavra
        },
      onSuccess: ajaxSuccess,
      onFailure: ajaxFailure
    }
  );
}

function ajaxSuccess(response){
    var data = JSON.parse(response.responseText);

    if(data.length > 0){    

        document.getElementById('resultados1').innerHTML = "Você obteve";
        document.getElementById('resultados2').innerHTML = data.length;
        document.getElementById('resultados3').innerHTML = "resultados";

        // Pegar o elemento pai -- ul
        var section = document.getElementById('section');
        for(var i = 0; i < data.length; i++){
            // Criar o formato do card -- li
            var card = document.createElement('li');
            // Inserindo class ao card (li)
            card.classList.add('card_curso');
            // Relacionar o card (li) com a section (ul)
            section.appendChild(card);

            // Criar elementos internos do card (li)

            //criando img de fundo
            var img1 = document.createElement('img');
            img1.setAttribute('src', '../images/img/image 10.svg');
            img1.classList.add('background');
            card.appendChild(img1);


            //Craindo a descrição do curso
            var descr = document.createElement('div');
            descr.classList.add('description');
            
                //Crianfo título no curso
                var titulo = document.createElement('h5');
                // Inserindo conteúdo no h2
                titulo.innerHTML = data [i]['titulo'];
                descr.appendChild(titulo);

                var scheme = document.createElement('div');
                scheme.classList.add('scheme');

                    var aulas = document.createElement('p');
                        var img2 = document.createElement('img');
                        img2.setAttribute('src', '../images/Icons/scheme_icon/student.svg');
                        aulas.appendChild(img2);

                        var span = document.createElement('span');
                        span.innerHTML = data[i]['num_aulas'] + " lesson";
                        aulas.appendChild(span);             
                    
                    scheme.appendChild(aulas);

                    var atividades = document.createElement('p');
                        var img3 = document.createElement('img');
                        img3.setAttribute('src', '../images/Icons/scheme_icon/pen.svg');
                        atividades.appendChild(img3);

                        var span = document.createElement('span');
                        span.innerHTML = data[i]['num_atividades'] +" tasks";
                        atividades.appendChild(span);
                    
                    
                    
                    scheme.appendChild(atividades);


                    var videos = document.createElement('p');
                        var img4 = document.createElement('img');
                        img4.setAttribute('src', '../images/Icons/scheme_icon/video.svg');
                        videos.appendChild(img4);

                        var span = document.createElement('span');
                        span.innerHTML = data[i]['num_videos'] +" videos";
                        videos.appendChild(span);
                    
                    scheme.appendChild(videos);

                descr.appendChild(scheme);

                var descricao = document.createElement('p');
                descricao.setAttribute('id', 'descricao');
                descricao.classList.add('descricao');
                descricao.innerHTML = data[i]['descricao'];
                descr.appendChild(descricao);

                var btn = document.createElement('div');
                btn.classList.add('btn');

                    var buttom = document.createElement('buttom');
                    buttom.innerHTML = "Study";
                    buttom.classList.add('card_curso_description_btn');
                    buttom.setAttribute('onclick', 'newcurso('+ data[i]['id'] +')');
                    btn.appendChild(buttom);

                    var link = document.createElement('a')
                    link.innerHTML = "More";
                    link.setAttribute('id', 'saibamais')
                    link.setAttribute('onclick', 'show_descricao()')
                    link.classList.add('card_curso_description_a');
                    btn.appendChild(link);

                descr.appendChild(btn);

            card.appendChild(descr);
        }
   }else{
        document.getElementById('resultados1').innerHTML = "Não há cursos com esse titulo, por favor, insira um titulo valído.";

   }
}
  
function ajaxFailure(response){
    alert(response.status);
}
function ClearReasult(){
    var section = document.getElementById('section');
    var cursos = [...document.getElementsByClassName('card_curso')];
    
    if(cursos.length > 0){  
         
        for(var i = 0; i < cursos.length; i++){
          section.removeChild(cursos[i]);
        }
    }
}
function newcurso(id){
    new Ajax.Request('../controllers/controllerinsercao.php', 
    {
      method: "get",
      parameters: {
          curso: id
        },
      onSuccess: newcurso_Success,
      onFailure: newcurso_Failure
    }
  );
}
function newcurso_Success(response){
  var respo = response.responseText;

  licao(respo);
}
function newcurso_Failure(response){

  var aviso = document.createElement('div');
  aviso.classList.add('msg_erro');

  var conteudo = document.createElement('p');
  conteudo.innerHTML = response.Status;
  aviso.appendChild(conteudo);

  var btn = document.createElement('button');
  btn.classList.add('btn');
  btn.innerHTML = 'OK';
  aviso.appendChild(btn);


}
function licao(n){
  location.href = '../views/licao.php?id=' + n;
}
// função deletar o elemento da tela sem recarregar e chama a função de apagar o curso do banco de dados
function call_deletar(n){
  var trash = document.getElementById(n);
  var F_trash = trash.parentNode;
  F_trash.removeChild(trash);
  deletar(n);

}
//função que deleta o curso do banco de dados
function deletar(n){
  new Ajax.Request('../controllers/controllerdeletar.php', {
    method: 'get',
    parameters:{id: n},
    onSuccess: deletar_sucesso,
    onFailure: deletar_failure
  })
  
}
function deletar_sucesso(){
  
}
function deletar_failure(response){
  alert(response.Status)
}
function show_descricao(){
  var descricao = document.getElementById('descricao');
  descricao.classList.remove('descricao');
  descricao.classList.add('show_descricao');
  var more = document.getElementById('saibamais');
  more.innerHTML = "Less";
  more.setAttribute('onclick', 'hidden_descricao()')
}
function hidden_descricao(){
  var more = document.getElementById('saibamais');
  more.innerHTML = "More";
  var descricao = document.getElementById('descricao');
  descricao.classList.remove('show_descricao');
  descricao.classList.add('descricao');
  more.setAttribute('onclick', 'show_descricao()')
}
