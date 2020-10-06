

function increm(id){
    $.ajax({
                type: "GET",
                url: "/cart/increm/"+id,
                contentType: 'application/json',
                success: function(result) {
                    console.log(result);
        if(result.success){
            console.log(result.priceAll);
        document.getElementById("cart_number"+id).value = result.number ;
        document.getElementById("total_price"+id).innerHTML = result.number*result.price ;
        document.getElementById("total_price_All").innerHTML = result.priceAll ;
        document.getElementById("cart_number_All").innerHTML = result.numberAll ;
        document.getElementById("number_All").innerHTML = result.numberAll ;
        }
        }

        });



  }


  function decrem(id){
    $.ajax({
                type: "GET",
                url: "/cart/decrem/"+id,
                contentType: 'application/json',
                success: function(result) {
        if(result.success){
            console.log(result.priceAll);
        document.getElementById("cart_number"+id).value = result.number ;
        document.getElementById("total_price"+id).innerHTML = result.number*result.price ;
        document.getElementById("total_price_All").innerHTML = result.priceAll ;
        document.getElementById("cart_number_All").innerHTML = result.numberAll ;
        document.getElementById("number_All").innerHTML = result.numberAll ;
        }
        }

        });



  }


  function deleteimage(id,imageName){
    Swal.fire({
        title: 'ต้องการลบรูปภาพนี้ไหม?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'ยืนยันลบ',
        cancelButtonText: 'ยกเลิก'
      }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "GET",
                url: "/admin/deleteImage/"+id+"/"+imageName,
                contentType: 'application/json',
                success: function(result) {
                    console.log(result.success);
                    console.log(result.imageName);

                    if(result.imageName === 'image2'){
                        document.getElementById("img2"+id).src = "";
                        document.getElementById("btnimg2"+id).style.display = 'none';
                        document.getElementById("i_img2"+id).style.display = 'none';
                    }else if(result.imageName === 'image3'){
                        document.getElementById("img3"+id).src = "";
                        document.getElementById("btnimg3"+id).style.display = 'none';
                        document.getElementById("i_img3"+id).style.display = 'none';
                    }else if(result.imageName === 'image4'){
                        document.getElementById("img4"+id).src = "";
                        document.getElementById("btnimg4"+id).style.display = 'none';
                        document.getElementById("i_img4"+id).style.display = 'none';
                    }

                     console.log( document.getElementById("btnimg4"+id));


        }
      })
        }
      })



  }




function cartNumber(id){
    console.log('ok');
    let number = document.getElementById('cart_number'+id).value;
    $.ajax({
        type:"post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        data: {
            id:id,
            number:number
        },
        url: "/cart/input_number",
        success: function(res){
            console.log(res);
            if(res.success){
                console.log(res.priceAll);
            document.getElementById("cart_number"+id).value = res.number ;
            document.getElementById("total_price"+id).innerHTML = res.number*res.price ;
            document.getElementById("total_price_All").innerHTML = res.priceAll ;
            document.getElementById("cart_number_All").innerHTML = res.numberAll ;
            document.getElementById("number_All").innerHTML = res.numberAll ;
            }
        }
    })
    console.log(number);
}
