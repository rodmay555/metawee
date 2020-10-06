<!DOCTYPE html>
<html  lang="th" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>

    <style>
        @font-face {
             font-family: 'THSarabunNew';
             font-style: normal;
             font-weight: normal;
             src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
         }
         @font-face {
             font-family: 'THSarabunNew';
             font-style: normal;
             font-weight: bold;
             src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
         }
         @font-face {
             font-family: 'THSarabunNew';
             font-style: italic;
             font-weight: normal;
             src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
         }
         @font-face {
             font-family: 'THSarabunNew';
             font-style: italic;
             font-weight: bold;
             src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
         }

         body {
             font-family: "THSarabunNew";
             margin: 0;
             padding: 0;
         }

         .re_ceter{
             text-align: center;
         }

         .herd_content{
             border: 1px solid #000;
             width:100%;



         }

         .herd1{


             color: darkcyan;

         }

         .herd2{



         }

         table{
             border: 1px solid #000;
             margin: 0;
             padding: 0;
             border-spacing: 0px;
         }

        td.herd1{
            border-right: 1px solid #000;
            margin: 0;
             padding: 10px;
        }

        td.herd1 p{
            margin: 0;
            margin-top: 5px;
        }

        td.herd1 h2{
            margin: 0;
        }


        td.herd2 {
            margin: 0;
             padding: 10px;
             padding-top: 10px;
        }
        td.herd2 p {
            margin: 0;
        }

        td.herd3{
            padding: 10px;
            margin: 0;
        }

        td.herd3 p{
            padding: 0px;
            margin: 0;
        }

        td.herd4{
            padding: 10px;
            margin: 0;
        }

        td.herd4 p{
            padding: 0px;
            margin: 0;
        }

        table.te_1{
            margin-top: 10px;
        }

        td.center{
            text-align: center;
        }

        table.roo{
            border-collapse: collapse;
        }

        table.roo ,td.roo , th.roo {
            border: 1px solid black;
        }

        .roo1{
            width: 85.7%;
        }

        .pa{
            margin-top: 0px ;
        }


        table.roo2{
            border-collapse: collapse;
            border-top: 0px solid black;
        }

        table.roo2 ,td.roo2 , th.roo2 {
            border: 1px solid black;
            border-top: 0px solid black;
        }


        .center1{
            text-align: right;
            padding-right: 10px
        }

     </style>




</head>
<body>


        <h1 class="re_ceter">ใบเสร็จรับเงิน/ใบส่งสินค้า</h1>
        <table  width="100%" style="width:100%" >
        <tr >
            <td class="herd1"><h2>ผลิตภัณฑ์ชาเมียง</h2><p>หมู้ 2 ต.ป่าแป๋ อ.แม่แตง จ.เชียงใหม่ 50200</p></td>
        <td class="herd2"><p><strong>ชื่อผู้ใช้ <strong>{{Auth::user()->name}}</p>
                                <p><strong>ชื่อ-นามสกุล <strong>{{$order_herd->delivery->firstname."  ".$order_herd->delivery->lastname}}</p>
                                <p><strong>ที่อยู่<strong> {{$order_herd->delivery->address}}</p>
                                <p><strong>เบอร์โทร <strong>{{$order_herd->delivery->phone_number}}</p>
            </td>
        </tr>
    </table>
        <table class="te_1" width="100%" style="width:100%" border="0">
            <tr>
              <td class="herd3"><p>หมายเลขการสั่งซื้อ {{$order_herd->number_order}}</p></td>
              <td class="herd4">วันที่ {{$order_herd->created_at}}</td>

            </tr>

          </table>

          <table class="te_1" width="100%" style="width:100%" border="0">
            <tr>
              <td class="herd3"><p>บริษัทการจัดส่ง : {{$order_herd->delivery->delivery_rate_d->company}}</p></td>
              <td class="herd4">ค่าจัดส่ง {{$order_herd->delivery->delivery_rate_d->price_rates}} บาท</td>

            </tr>

          </table>

          <table class="te_1 roo" width="100%">
            <tr>
              <th  class="roo">ลำดับ</th>
              <th  class="roo">รายการ</th>
              <th  class="roo">ราคาต่อหน่วย</th>
              <th  class="roo">จำนวน </th>
              <th  class="roo">ราคารวม</th>
            </tr>
            <?php
                $i=1;
                $price_all = 0;
            ?>
            @foreach($order_herd->order_list as $list )
            <tr >
              <td class="center roo">{{$i}}</td>
              <td class="center roo">{{$list->product->name}}</td>
              <td class="center roo">{{$list->product->price}}</td>
              <td class="center roo">{{$list->number}}</td>
              <td class="center roo">{{$list->product->price*$list->number}}</td>
            </tr>

            <?php
                    $i+=1;
                    $price_all += $list->product->price*$list->number;
            ?>

            @endforeach
          </table>

          <table class="roo2 pa" width="100%">
            <tr>
              <td  class="roo1 center1 ">รวม</td>
              <td  class="roo2 center1">{{$price_all}}</td>


            </tr>


          </table>
          <table class="roo2 pa" width="100%">
            <tr>
              <td  class="roo1 center1">ค่าจัดส่ง</td>
              <td  class="roo2 center1">{{$order_herd->delivery->delivery_rate_d->price_rates}}</td>


            </tr>


          <table class="roo2 pa" width="100%">
            <tr>
              <td  class="roo1 center1">ราคารวมสุทธิ</td>
              <td  class="roo2 center1">{{$price_all+$order_herd->delivery->delivery_rate_d->price_rates}}</td>


            </tr>


          </table>

</body>
</html>
