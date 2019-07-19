 $(document).ready(function(){
     $('.delete').click(function() {
            var del = $(this)
            var id = $(this).data('id');

            var catId = $(this).data('cat-id');
            $.ajax({
                url: 'delete.php',
                type: 'post',
                data: {id: id, cat_id: catId},
                success: function(e){
                    console.log(e);
                    del.parent().parent().prev().find('span').html(e);
                    if(e == 0){
                        del.parent().parent().prev().find('span').html(0);
                    }
                    del.parent().parent().fadeOut(500);
                }

            });
            
        });
 })
 
 
 
