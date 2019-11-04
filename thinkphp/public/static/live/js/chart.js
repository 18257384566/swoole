var wsurl = 'ws://118.31.109.21:8812';

var websocket = new WebSocket(wsurl);

//实例对象的onopen属性
websocket.onopen = function(evt){
    console.log("conected-swoole-success");
}

//实例化 onmessage
websocket.onmessage = function(evt){
    push(evt.data);
    console.log("web-server-return-data:" + evt.data);
}

websocket.onclose = function(evt){
    console.log("close");
}

websocket.onerror = function(evt, e){
    console.log("error:" + evt.data);
}

function push(){
    data = JSON.parse(data);
    html = "<div class='content'>";
    html += '<span>'+data.user+'</span>';
    html += '<span>'+data.content+'</span>';
    html += '</div>';
}