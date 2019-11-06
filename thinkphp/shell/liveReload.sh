echo 'loading...'
pid=`pidof live_swoole`
echo $pid
kill -USR1 $pid
echo 'loading success'
