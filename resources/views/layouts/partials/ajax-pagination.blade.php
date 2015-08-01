@section('footer')
    <script src="{{asset('js/jquery-ias.min.js')}}"></script>
    <script>
        $(function(){
                var ias = $.ias({
                    container:  "{{$container}}",
                    item:       "{{$itemClass}}",
                    pagination: "{{$paginateDiv}}",
                    next:       "{{$nextPageLink}}"
                });
                ias.extension(new IASSpinnerExtension());            // shows a spinner (a.k.a. loader)
                ias.extension(new IASTriggerExtension({
                    offset: 1,
                    text: '<div class="text-success" style="padding-top:10px;padding-bottom:20px;">Load more?</div>'
                })); // shows a trigger after page 3

                ias.extension(new IASNoneLeftExtension({
                    text: '<div class="text-info" style="padding-top:10px;padding-bottom: 20px">Thats it, nothing more to load.</div>'      // override text when no pages left
                }));
        });
    </script>
@stop