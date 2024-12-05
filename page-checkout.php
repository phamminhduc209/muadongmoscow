<?php
/*
Template Name: Checkout page
*/

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Mùa Đông Moscow 2024 là một sự kiện âm nhạc và giải trí đặc biệt dành cho cộng đồng người Việt Nam tại Liên bang Nga, diễn ra vào  ngày 15, 16 và 17 tháng 12 năm 2024 tại Nhà Hàng Cửu Long và trung tâm tiệc Гранат Холл thuộc quần thể chợ Liubilino.">
	<meta name="keywords" content="Mùa Đông Moscow 2024">
    <title>Mùa Đông Moscow 2024</title>
    <?php get_header(); ?>
</head>
<?php
$checkoutBanner = get_field('checkout_banner', 'option');

$hotline1_label = get_field('hotline_1_label', 'option');
$hotline1_number = get_field('hotline_1_number', 'option');

$hotline2_label = get_field('hotline_2_label', 'option');
$hotline2_number = get_field('hotline_2_number', 'option');
$email_info = get_field('email', 'option');
$copyright = get_field('copyright', 'option');

?>

<body <?php body_class(); ?>>

    <div class="p-checkout">
        <div class="p-checkout__parallax" style="background-image: url('<?php echo $checkoutBanner; ?>');"></div>
        <div class="p-checkout__content py-50" id="checkout">
            <div class="inner">
                <div class="p-checkout__wrap">
                    <div class="p-checkout__dt">
                        <p class="hline03 hline03--black text-center text-uppercase mb-0 font-nunito">Đặt vé</p>
                        <h2 class="hline02 hline02--black text-center text-uppercase mb-50 font-nunito">Mùa đông Moscow 2024</h2>
                        <div class="lst-dt">
                            <?php
                            // Get all terms of a specific taxonomy
                            $events = get_terms([
                                'taxonomy' => 'event',
                                'hide_empty' => true, // Set to false to show empty terms
                            ]);

                            // Foreach loop to display terms
                            foreach ($events as $eventItem):
                                $eventName =  $eventItem->name; // Term name
                                $eventDesc = $eventItem->description;
                                $eventId = $eventItem->term_id; // Term ID

                            ?>
                                <div class="lst-dt__item">
                                    <div class="lst-dt__head">
                                        <h3 class="lst-dt__name"><?php echo $eventName; ?></h3>
                                        <p class="lst-dt__time mt-5"><?php echo $eventDesc; ?></p>
                                        <div class="ic">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z"></path></svg>
                                        </div>
                                    </div>
                                    <div class="lst-dt__content mt-20">
                                        <?php
                                        $ticketsByEvent = new WP_Query([
                                            'post_type' => 'ticket',
                                            'tax_query' => [
                                                [
                                                    'taxonomy' => 'event',
                                                    'field' => 'term_id',
                                                    'terms' => [$eventId],
                                                    'operator' => 'IN',
                                                ],
                                            ],
                                        ]);
                                        if ($ticketsByEvent->have_posts()):
                                            while ($ticketsByEvent->have_posts()):
                                                $ticketsByEvent->the_post();
                                                $ticketName = get_the_title();
                                                $ticketId = get_the_ID();
                                                $ticketPrice = get_field('price', $ticketId);
                                                $ticketDesc = get_field('desciption', $ticketId);
                                                $ticketMetaData = [
                                                    'ticket_id' => $ticketId,
                                                    'event_id' => $eventId,
                                                    'event_name' => $eventName . ' - ' .  $eventDesc,
                                                    'ticket_name' => $ticketName,
                                                    'price' => $ticketPrice,

                                                ];
                                        ?>
                                                <div class="item">
                                                    <div>
                                                        <p>Giá vé đã bao gồm: </p>
                                                        <ul class="mt-5">
                                                            <?php foreach ($ticketDesc as $tDes): ?>
                                                                <li><?php echo $tDes['title']; ?></li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                    <div class="total">
                                                        <p class="text-center"><strong><?php echo $ticketPrice; ?><small>₽</small><br><?php echo $ticketName; ?></strong></p>
                                                        <div class="qtySelector text-center">
                                                            <p class="fa fa-minus decreaseQty"><img src="/wp-content/themes/muadongmosco/assets/images/minus-svgrepo-com.svg" alt=""></p>
                                                            <input data-meta="<?php echo htmlspecialchars(json_encode($ticketMetaData), ENT_QUOTES, 'utf-8'); ?>" type="text" class="qtyValue" value="0" />
                                                            <p class="fa fa-plus increaseQty"><img src="/wp-content/themes/muadongmosco/assets/images/plus-svgrepo-com.svg" alt=""></p>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php endwhile;
                                            wp_reset_postdata();
                                        endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                    <div data-header-area>
                        <div class="p-checkout__side" data-header-nav-area>
                            <form method="" action="" class="frm" id="book-form">
                                <h3 class="frm-ttl font-nunito">Thông tin cá nhân</h3>
                                <div class="mt-10">
                                    <div class="frm-item">
                                        <input value="" type="text" name="name" value="" placeholder="Tên" class="form-control">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-4 h-4 absolute right-4" viewBox="0 0 24 24">
                                            <circle cx="10" cy="7" r="6" data-original="#000000"></circle>
                                            <path d="M14 15H6a5 5 0 0 0-5 5 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 5 5 0 0 0-5-5zm8-4h-2.59l.3-.29a1 1 0 0 0-1.42-1.42l-2 2a1 1 0 0 0 0 1.42l2 2a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42l-.3-.29H22a1 1 0 0 0 0-2z" data-original="#000000"></path>
                                        </svg>
                                    </div>
                                    <div class="frm-item">
                                        <input value="" type="email" name="email" value="" placeholder="Email" class="form-control">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-4 h-4 absolute right-4" viewBox="0 0 682.667 682.667">
                                            <defs>
                                                <clipPath id="a" clipPathUnits="userSpaceOnUse">
                                                    <path d="M0 512h512V0H0Z" data-original="#000000"></path>
                                                </clipPath>
                                            </defs>
                                            <g clip-path="url(#a)" transform="matrix(1.33 0 0 -1.33 0 682.667)">
                                                <path fill="none" stroke-miterlimit="10" stroke-width="40" d="M452 444H60c-22.091 0-40-17.909-40-40v-39.446l212.127-157.782c14.17-10.54 33.576-10.54 47.746 0L492 364.554V404c0 22.091-17.909 40-40 40Z" data-original="#000000"></path>
                                                <path d="M472 274.9V107.999c0-11.027-8.972-20-20-20H60c-11.028 0-20 8.973-20 20V274.9L0 304.652V107.999c0-33.084 26.916-60 60-60h392c33.084 0 60 26.916 60 60v196.653Z" data-original="#000000"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="frm-item">
                                        <input value="" type="text" name="phone" value="" placeholder="Phone No." class="form-control">
                                        <svg fill="#bbb" class="w-4 h-4 absolute right-4" viewBox="0 0 64 64">
                                            <path d="m52.148 42.678-6.479-4.527a5 5 0 0 0-6.963 1.238l-1.504 2.156c-2.52-1.69-5.333-4.05-8.014-6.732-2.68-2.68-5.04-5.493-6.73-8.013l2.154-1.504a4.96 4.96 0 0 0 2.064-3.225 4.98 4.98 0 0 0-.826-3.739l-4.525-6.478C20.378 10.5 18.85 9.69 17.24 9.69a4.69 4.69 0 0 0-1.628.291 8.97 8.97 0 0 0-1.685.828l-.895.63a6.782 6.782 0 0 0-.63.563c-1.092 1.09-1.866 2.472-2.303 4.104-1.865 6.99 2.754 17.561 11.495 26.301 7.34 7.34 16.157 11.9 23.011 11.9 1.175 0 2.281-.136 3.29-.406 1.633-.436 3.014-1.21 4.105-2.302.199-.199.388-.407.591-.67l.63-.899a9.007 9.007 0 0 0 .798-1.64c.763-2.06-.007-4.41-1.871-5.713z" data-original="#000000"></path>
                                        </svg>
                                    </div>
                                </div>
                                <ul class="mt-20">
                                    <li class="d-flex font-nunito">
                                        Tổng tiền
                                        <span class="ml-auto">
                                            <strong id="total-price">0</strong><small>₽</small>
                                        </span>
                                    </li>
                                </ul>
                                <div class="frm-discount my-20">
                                    <div class="d-flex">
                                        <input value="" type="text" name="discount-code" placeholder="Mã giảm giá" class="form-control">
                                        <button type="button" class="frm-discount__btn font-nunito">Áp dụng</button>
                                    </div>
                                </div>
                                <div class="frm-payment my-20">
                                    <p class="frm-payment__ttl font-nunito mb-5"><strong>Chọn phương thức thánh toán:</strong></p>
                                    <div class="frm-payment__item">
                                        <div class="wrap">
                                            <input type="radio" id="payment1" name="payment" value="transfer" checked>
                                            <label for="payment1" class="font-nunito">Chuyển khoản qua ngân hàng</label>
                                        </div>
                                    </div>
                                    <div class="frm-payment__item">
                                        <div class="wrap">
                                            <input type="radio" id="payment2" name="payment" value="agency">
                                            <label for="payment2" class="font-nunito">Qua Agency</label>
                                        </div>
                                        <div class="child-div" id="agency">
                                            <?php
                                            $agencyLabel = get_field('agency_label', 'option');
                                            $agencyList = get_field('agency_list', 'option');
                                            ?>
                                            <p class="font-nunito mt-5"><?php echo $agencyLabel; ?></p>
                                            <select name="agency-info" class="form-control font-nunito mt-5 mb-10">
                                                <?php foreach ($agencyList as $agencyItem):
                                                    $agencyName = $agencyItem['name'];

                                                ?>
                                                    <option value="<?php echo  $agencyName; ?>"><?php echo  $agencyName; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="frm-payment__item">
                                        <div class="wrap">
                                            <input type="radio" id="payment3" name="payment" value="cash">
                                            <label for="payment3" class="font-nunito">Tiền mặt</label>
                                        </div>
                                        <div class="child-div" id="cash">
                                            <p class="font-nunito mt-5">Nhập địa chỉ của bạn</p>
                                            <input type="text" name="address" value="" class="form-control font-nunito mt-5" placeholder="Nhập địa chỉ của bạn">
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary font-nunito" id="book-ticket">Đặt vé</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="p-footer pt-50 pb-30">
        <div class="container">
            <div class="text-center">
                <p><a href="mailto:<?php echo $email_info; ?>"><?php echo $email_info; ?></a></p>
                <p class="mt-20">Hotline đặt vé</p>
                <p class="mt-10"><a href="tel:<?php echo $hotline1_number; ?>" title="<?php echo $hotline1_label; ?>"><?php echo $hotline1_label; ?></a></p>
                <div class="mt-15">Hotline Ban tổ chức</div>
                <p class="mt-10"><a href="tel:<?php echo $hotline2_number; ?>" title="<?php echo $hotline2_label; ?>"><?php echo $hotline2_label; ?></a></p>
                <!-- <div class="p-footer__copy pt-20"><?php echo $copyright; ?></div> -->
            </div>
        </div>
    </footer>

    <div id="dialog-checkout1" class="p-popup">
        <div class="p-popup__wrap p-checked">
            <p class="ic">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-14 shrink-0 fill-green-500 inline" viewBox="0 0 512 512">
                    <path d="M383.841 171.838c-7.881-8.31-21.02-8.676-29.343-.775L221.987 296.732l-63.204-64.893c-8.005-8.213-21.13-8.393-29.35-.387-8.213 7.998-8.386 21.137-.388 29.35l77.492 79.561a20.687 20.687 0 0 0 14.869 6.275 20.744 20.744 0 0 0 14.288-5.694l147.373-139.762c8.316-7.888 8.668-21.027.774-29.344z" data-original="#000000"></path>
                    <path d="M256 0C114.84 0 0 114.84 0 256s114.84 256 256 256 256-114.84 256-256S397.16 0 256 0zm0 470.487c-118.265 0-214.487-96.214-214.487-214.487 0-118.265 96.221-214.487 214.487-214.487 118.272 0 214.487 96.221 214.487 214.487 0 118.272-96.215 214.487-214.487 214.487z" data-original="#000000"></path>
                </svg>
            </p>
            <p class="text-center font-nunito"><strong>Đặt Vé Thành Công</strong></p>
            <p class="text-center txt font-nunito cl-gray mt-10">Hệ thống của chúng tôi đang xử lý và sẽ phản hồi ngay khi đơn đặt vé của bạn được xác nhận. Kiểm tra email của bạn để xem thông tin chi tiết.</p>
            <p class="text-uppercase text-center mt-10 font-nunito">Vui lòng thanh toán <strong class="amount d-total-price"><span></span><small>₽</small></strong></p>
            <div class="describe text-center mt-15">
                <p class="text-uppercase text-center font-nunito mb-5">Với nội dung chuyển khoản:</p>
                <strong class="amount font-nunito d-code"></strong>
                <button class="amount amount--copy font-nunito d-code-copy" data-copy="">Copy</button>
            </div>
            <div class="detail mt-15">
                <?php
                $accountName = get_field('account_name', 'option');
                $accountNumber = get_field('account_number', 'option');
                $qrCode = get_field('qr_code', 'option');
                $bank = get_field('bank', 'option');
                ?>
                <p class="text-uppercase text-center mt-5 font-nunito">Số tài khoản: <strong><?php echo $accountNumber; ?></strong> <button class="amount amount--copy font-nunito" data-copy="<?php echo $accountNumber; ?>">Copy</button></p>
                <p class="text-uppercase text-center mt-5 font-nunito">Tên chủ tài khoản: <strong><?php echo $accountName; ?></strong> <button class="amount amount--copy font-nunito" data-copy="<?php echo $accountName; ?>">Copy</button></p>
                <p class="text-uppercase text-center mt-5 font-nunito">Hoặc qr code sau:</p>
                <div class="mt-5 qrcode"><img alt="QR Code" srcset="<?php echo $qrCode; ?> 1x, <?php echo $qrCode; ?> 2x" class="w-64 h-64" src="<?php echo $qrCode; ?>"></div>
                <div class="mt-20 font-nunito">
                    <button type="button" class="btn btn-primary" id="confirm-paid-ticket">Xác nhận đã chuyển khoản</button>
                </div>
            </div>
        </div>
    </div>

    <div id="dialog-checkout2" class="p-popup">
        <div class="p-popup__wrap p-checked">
            <p class="ic">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-14 shrink-0 fill-green-500 inline" viewBox="0 0 512 512">
                    <path d="M383.841 171.838c-7.881-8.31-21.02-8.676-29.343-.775L221.987 296.732l-63.204-64.893c-8.005-8.213-21.13-8.393-29.35-.387-8.213 7.998-8.386 21.137-.388 29.35l77.492 79.561a20.687 20.687 0 0 0 14.869 6.275 20.744 20.744 0 0 0 14.288-5.694l147.373-139.762c8.316-7.888 8.668-21.027.774-29.344z" data-original="#000000"></path>
                    <path d="M256 0C114.84 0 0 114.84 0 256s114.84 256 256 256 256-114.84 256-256S397.16 0 256 0zm0 470.487c-118.265 0-214.487-96.214-214.487-214.487 0-118.265 96.221-214.487 214.487-214.487 118.272 0 214.487 96.221 214.487 214.487 0 118.272-96.215 214.487-214.487 214.487z" data-original="#000000"></path>
                </svg>
            </p>
            <p class="text-center font-nunito"><strong>Cảm ơn quý khách!</strong></p>
            <p class="text-center txt font-nunito cl-gray">Cảm ơn quý khách! húng tôi sẽ kiểm tra và sẽ liên hệ quý khách để xác nhận thanh toán.</p>
            <p class="text-center txt font-nunito cl-gray mt-20">Nếu cần hỗ trợ thêm, quý khách có thể liên hệ chúng tôi qua hotline:</p>
            <ul class="text-center mt-5">
                <li>
                    <p class="font-nunito"><a href="tel:<?php echo $hotline1_number; ?>" title="<?php echo $hotline1_label; ?>"><?php echo $hotline1_label; ?></a></p>
                </li>
                <li>
                    <p class="font-nunito"><a href="tel:<?php echo $hotline2_number; ?>" title="<?php echo $hotline2_label; ?>"><?php echo $hotline2_label; ?></a></p>
                </li>
                <li>
                    <p><span class="txt font-nunito cl-gray">hoặc email: </span><a href="mailto:<?php echo $email_info; ?>"><?php echo $email_info; ?></a></p>
                </li>
            </ul>
        </div>
    </div>

    <div id="dialog-checkout-error" class="p-popup">
        <div class="p-popup__wrap p-checked">
            <p class="br">
                <svg class="h-6 w-6  fill-red-color text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </p>
            <p class="text-center font-nunito"><strong>Error!</strong></p>

            <ul class="text-center mt-5" id="error-data">

            </ul>
        </div>
    </div>

    <div id="dialog-confirm" class="p-popup">
        <div class="p-popup__wrap p-checked">
            <p class="ic">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-14 shrink-0 fill-green-500 inline" viewBox="0 0 512 512">
                    <path d="M383.841 171.838c-7.881-8.31-21.02-8.676-29.343-.775L221.987 296.732l-63.204-64.893c-8.005-8.213-21.13-8.393-29.35-.387-8.213 7.998-8.386 21.137-.388 29.35l77.492 79.561a20.687 20.687 0 0 0 14.869 6.275 20.744 20.744 0 0 0 14.288-5.694l147.373-139.762c8.316-7.888 8.668-21.027.774-29.344z" data-original="#000000"></path>
                    <path d="M256 0C114.84 0 0 114.84 0 256s114.84 256 256 256 256-114.84 256-256S397.16 0 256 0zm0 470.487c-118.265 0-214.487-96.214-214.487-214.487 0-118.265 96.221-214.487 214.487-214.487 118.272 0 214.487 96.221 214.487 214.487 0 118.272-96.215 214.487-214.487 214.487z" data-original="#000000"></path>
                </svg>
            </p>
            <p class="text-center font-nunito"><strong>Cảm ơn quý khách!</strong></p>
            <p class="text-center txt font-nunito cl-gray mt-10">Cảm ơn quý khách đã thanh toán! Hệ thống của chúng tôi sẽ kiểm tra và vé sẽ được gửi qua email ngay sau khi nhận được thông tin thanh toán từ quý khách.</p>
            <p class="text-center txt font-nunito cl-gray mt-20">Nếu cần hỗ trợ thêm, quý khách có thể liên hệ chúng tôi qua hotline:</p>
            <ul class="text-center mt-5">
                <li>
                    <p class="font-nunito"><a href="tel:<?php echo $hotline1_number; ?>" title="<?php echo $hotline1_label; ?>"><?php echo $hotline1_label; ?></a></p>
                </li>
                <li>
                    <p class="font-nunito"><a href="tel:<?php echo $hotline2_number; ?>" title="<?php echo $hotline2_label; ?>"><?php echo $hotline2_label; ?> - Hotline</a></p>
                </li>
                <li>
                    <p><span class="txt font-nunito cl-gray">hoặc email: </span><a href="mailto:<?php echo $email_info; ?>"><?php echo $email_info; ?></a></p>
                </li>
            </ul>
        </div>
    </div>

    <?php
    get_footer();
    ?>
</body>

</html>