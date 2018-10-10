@extends('layouts.base')
@section('title', 'hoge')
@section('content')
<div class="ui container area">
<span id="target">{{$target}}</span>
<button type="button" id="word" class="ui button clicked">{{$target}}</button>
@foreach ($response as $res)
<button type="button" id="word" class="ui button">{{$res['title']}}</button>
@endforeach
</div>

<canvas id="canvassample" class="ui container"></canvas>

<script>
onload = function() {
    draw();
}
var w = $('#canvassample').width();
var h = $('#canvassample').height();
console.log(w);
function draw() {
    var canvas = document.getElementById('canvassample');
    if (! canvas || !canvas.getContext) {
        $('.area').append('<div class="alert">ない</div>').fadeIn("slow",function(){
            $('.alert').delay(3000).fadeOut("slow");
        });
    }

    var ctx = canvas.getContext('2d');
    ctx.strokeText($('#target').text(), w/2 ,h/2);
}

</script>

<script>
$(function(){
    var clicked = false;
    $(document).on('click', '#word', function(){
        var t = $(this).html();
        if (clicked) {
            // ダブルクリック
            url = 'https://ja.wikipedia.org/wiki/' + t;
            window.open('https://ja.wikipedia.org/wiki/' + $(this).html());
            clicked = false;
            return;
        }
        clicked = true;
        setTimeout(function () {
            if (clicked && !$("button:contains(" + t + ")").hasClass('checked')) {
            // シングルクリック && 初回クリック
                searchWord(t);
            }
            clicked = false;
        }, 300);
    });
})

function searchWord(t) {
    $.ajax({
        type: 'POST',
        url: '/wikiru/search',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: { 'search': t },
        dataType: 'JSON',
    })
    .done(function (response) {
        if ($.isEmptyObject(response['item'])) {
            // もしレスポンスが空なら
            $('.alert').hide();
            $('.body').append('<div class="alert">一致するページはありませんでした。</div>').fadeIn("slow",function(){
                $('.alert').delay(3000).fadeOut("slow");
            });
            return;
        }
        $.each(response['item'], function(index, val){
            $("button:contains(" + t + ")").addClass('checked');
            $('.area').append('<button type="button" class="ui button" id="word">' + val['title'] + '</button>');
        })
    })
    .fail(function () {
        $('.alert').hide();
        $('.col-md-6').append('<div class="alert">エラーが発生しました。</div>').fadeIn("slow",function(){
            $('.alert').delay(3000).fadeOut("slow");
        });
    })
}
/*
    放射配置
    クリックしたボタンにparentクラス、結果にchildrenクラス付与
    別のボタンクリック時にparent,childrenクラス削除→再配置

    parent の座標から周囲に特定範囲で放射状に配置
    配置したらparentからchildrenを直線で結ぶ
*/



</script>


@endsection
