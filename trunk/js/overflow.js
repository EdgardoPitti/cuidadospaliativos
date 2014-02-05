var touch = true;
window.onload = function(){
        oScroll.debug = true;
        cargarScrollMovil([["id", "overflow-movil", "hv"]]);
}; 

/* SCROLL PARA MOVILES QUE NO SOPORTAN OVERFLOW ------------------------------------------------
 * Se carga en todo caso en dispositivos que soporten touchevent, independientemente
 * de que tengan o no control de overflow.
 * El argumento objetivos de cargarScrollMovil() es un array de arrays, uno para
 * cada clase o elemento. con las siguientes posiciones:
 * 0: string "cls" o "id" para clase o identificador
 * 1: string nombre de clase o identificador
 * 2: string "h", "v" o "hv" para indicar scroll horizontal, vertical o ambos. Opcional, valor
 *    inicial "v". Con minúsculas se carga si el contenido sobrepasa el ancho o alto. Con
 *    mayúsculas se cargan siempre.
 * 3: string para incorporar estilo a los botones. Opcional, valor inicial "".
 */

function cargarScrollMovil(objetivos) {
        try {
                //Antes usaba navigator.userAgent para detectar Android 2.x pero ahora le pondremos
                //botones de scroll a cualquier navegador que soporte eventos de toque. La variable
                //oScroll.debug se pone a true en el window.onload de una página para probar
                //este componenente en navegadores que no soporten eventos de toque
                if (touch || oScroll.debug) {
                        //El argumento hv puede ser "h", "v" o "hv". Si es con mayúsculas inserta el scroll
                        //en cualquier caso. Con minúsculas sólo si el contenido es mayor.
                        function construirScroll(scmovs, hv, style) {
                                var htmls = [];
                                for (var i=0, maxi=scmovs.length; i<maxi; i++) {
                                        var objetivo = scmovs[i];
                                        var sgte = objetivo.nextSibling;
                                        //No lo cargamos si ya está cargado o si el contenido es vacío
                                        if ((objetivo.innerHTML.length==0)||
                                                (!(sgte && sgte.className && (sgte.className=="scroll-movil")))){
                                                var ow, sw, oh, sh;
                                                var H = (hv.indexOf("H")>-1);
                                                var V = (hv.indexOf("V")>-1);
                                                var h = (hv.indexOf("h")>-1);
                                                var v = (hv.indexOf("v")>-1);
                                                if (h) h = (h && (objetivo.scrollWidth > objetivo.offsetWidth));
                                                if (v) v = (v && (objetivo.scrollHeight > objetivo.offsetHeight));
                                                var html = "";
                                                if (h || H) html += htmlH;       
                                                if (v || V) html += htmlV;
                                                if (html != "") {
                                                        var sty = 'st yle="display:block; ' + style + '"';
                                                        html = '<div class="scroll-movil" id="scroll-movil"' + sty + '>' +
                                                                        html + '</div>';
                                                        htmls[htmls.length] = [scmovs[i], html];
                                                }
                                                
                                        } 
                                } 
                                for (var i=0, maxi=htmls.length; i<maxi; i++){
                                        htmls[i][0].insertAdjacentHTML("afterend", htmls[i][1]);
                                }
                        }   
                        var estilo = "";
                        var prefijos = ["moz", "webkit", "ms", "o"];
                        for (var i=0, max=prefijos.length; i<max; i++){
                                estilo += "-" + prefijos[i] + "-user-select: none; ";  
                        }
                        estilo += "user-select: none; ";
                        var arr = [[1,-1],[1,1],[0,-1],[0,1]];
                        var flechas = ["l", "r", "u", "d"];
                        var htmlH = "", htmlV = "";
                        //Antes tenía solo ontouchstart y ontouchend, pero Chrome 32 trata ambos
                        //eventos incluso en un navegador de sobremesa sin consultar si el dispositivo
                        //acepta eventos de toque. Esto es porque ya hay dispositivos que pueden aceptar
                        //TouchEvents y MouseEvents al mismo tiempo.
                        for (var i=0,maxi=arr.length; i<maxi; i++){
                                var cad = '<button class="scroll-movil-boton btn btn-default" ' +
                                'ontouchstart="iniciarScrollMovil(event,' + arr[i][0] + ',' + arr[i][1] + ')" ' +
                                'onmousedown="iniciarScrollMovil(event,' + arr[i][0] + ',' + arr[i][1] + ')" ' +                
                                'ontouchend="pararScrollMovil(event)" ' +
                                'onmouseup="pararScrollMovil(event)" ' +                
                                'style="' + estilo + '" unselectable="on">&' + flechas[i] + 'Arr;</button>';
                                if (i<2){
                                        htmlH += cad;
                                } else {
                                        htmlV += cad;
                                }
                        }
                        for (var i=0, maxi=objetivos.length; i<maxi; i++) {
                                var clsId = objetivos[i][0];
                                var nombre = objetivos[i][1];
                                var hv = "v";
                                if (objetivos[i].length>2) hv = objetivos[i][2];
                                var style = "";
                                if (objetivos[i].length>3) style = 'style="' + objetivos[i][3] + '"';
                                if (clsId=="cls") {
                                        construirScroll(document.getElementsByClassName(nombre), hv, style);
                                } else {
                                        var elemento = document.getElementById(nombre);
                                        if (elemento) construirScroll([elemento], hv, style);
                                }
                        }
                }

        } catch(e) {
                alert(e.message);
                //no capturamos nada
        }
}

/* Objeto que contiene variables temporales que se inicializan con touchstart y así
 * poder usarlas mientras se mantiene el toque hasta touchend. La variable debug permite
 * evitar document.createEvent("TouchEvent") en cargarScrollMovil() y poder verlo 
 * funcionando en navegadores NO móviles como Chrome y su facilidad para simular
 * user-agent.
 */
oScroll = {
        interval: null,
        elemento: null,
        mm: 0,    
        hv: 0,
        debug: false
};

function iniciarScrollMovil(event, hv, masMenos) {
        if (event.preventDefault) event.preventDefault();
        oScroll.interval = window.clearInterval(oScroll.interval);
        oScroll.interval = null;    
        var elemento = event.target || event.srcElement;
        var padre = elemento.parentNode || elemento.parentElement;
        oScroll.elemento = padre.previousSibling;
        var estiloActual = oScroll.elemento.currentStyle || 
                document.defaultView.getComputedStyle(oScroll.elemento, null) ;
        var salto = Math.round(parseInt(estiloActual["height"])/5);
        if (salto<48) salto = 48;
        oScroll.mm = salto * masMenos;
        oScroll.hv = hv;
        oScroll.interval = window.setInterval(function(){
                if (oScroll.hv==0) {
                        //en vertical
                        oScroll.elemento.scrollLeft = 0;
                        oScroll.elemento.scrollTop += oScroll.mm;
                } else {
                        //en horizontal
                        oScroll.elemento.scrollLeft += oScroll.mm;
                }           
        
        }, 100);
}

function pararScrollMovil(event){
        if (event.preventDefault) event.preventDefault();
        oScroll.interval = window.clearInterval(oScroll.interval);
        oScroll.interval = null;    
}