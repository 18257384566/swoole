var wsurl = 'ws://118.31.109.21:9111';

var websocket = new WebSocket(wsurl);

//实例对象的onopen属性
websocket.onopen = function(evt){
    // websocket.send('send:hello');
    console.log("conected-swoole-success");
}

//实例化 onmessage
websocket.onmessage = function(evt){
    console.log("web-server-return-data:" + evt.data);
}

websocket.onclose = function(evt){
    console.log("close");
}

websocket.onerror = function(evt, e){
    console.log("error:" + evt.data);
}