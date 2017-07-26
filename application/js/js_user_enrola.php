<script src="<?php echo base_url(); ?>application/js/sa_hw_connect.js"></script>
<script type="text/javascript" defer="True">
var enrolado=false;
console.log("me entro o:");

var WS = $.hwWebSocket({
    camIP: "172.16.253.124",
    camPORT: 4370,
    webSoketPath:"ws://localhost:42427",
    onopenCallBack:function () {
        $("#estado").text("Estado: Conectado");
        WS.RFID_getStatus();
        WS.CAM_conect();
    },
    oncloseCallBack:function () {
        $("#estado").text("Estado: Desconectado")
        $("#CamStatus").css({"background-color":"#777"}).text("Off");
    }
});

$("#btnStartEnroll").on("click",function(e){
    e.preventDefault();
    console.log("user id: "+<?php echo($trabajador->id_user) ?>);
    WS.CAM_startEnroll({
        "id":<?php echo($trabajador->id_user) ?>,
        "name":$("input[name=nombre]").val()+" "+$("input[name=apellido]").val()
    });
});

WS.addOnSatusEventHandler(function(json){
    console.log(json.dispositivo)
    if(json.dispositivo=="RFID"){
        $("#TagStatus").css({"color":(json.status=="Conectado")?"green":"black"});
    }else if(json.dispositivo="CAM"){
        $("#CamStatus").css({"background-color":(json.status=="Conectado")?"#449d44":"#777"}).text((json.status=="Conectado")?"On":"Off");
        if(json.status=="Conectado")
            $("#btnStartEnroll").removeClass('disabled');
        else
            $("#btnStartEnroll").addClass('disabled');
    }
});

WS.addFaceDetectionEventHandler(function(data){
    if(data.usuario.id == <?php echo($trabajador->id_user) ?>){
        $("#Enrolled").removeClass('hidden');
        console.log($("#btnSubmit"))
        $("#btnSubmit").removeClass("disabled");
        $("#chkEnrolado").prop('checked', true);
        enrolado=true;
    }
    else
        console.warn("se registró un usuario diferente");
});

console.log($("form"));

$("form").submit(function(e){
    if(!enrolado)
        e.preventDefault();
    else
        console.log("listo")
});
</script>