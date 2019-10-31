$(function(){

    $('#discuss-box').onkeydown(function(event){
        if(event.KeyCode == 13){//回车事件
            var text = $(this).val();
            var url = 'http://118.31.109.21:9111/?s=index/chart/index';
            var data = {'content':text, 'game_id':1};

            $.post(url,data,function(result){
                //todo
                $(this),val('');
            },'json');
        }
    });

});