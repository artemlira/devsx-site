<?php
$title = get_field('block_contacts_bottom_heading');
$title_value = get_field('block_contacts_bottom_heading_value');
$phone = get_field('block_contacts_bottom_phone');
$email = get_field('block_contacts_bottom_email');
$chat = get_field('block_contacts_bottom_chat');
?>

<section class="contacts-bottom-block wow fadeIn">
  <div class="container">
    <div class="content">
      <<?php echo $title_value; ?> class="wow fadeInUp" data-wow-delay="0.1s"><?php echo $title;?></<?php echo $title_value; ?>>
      <div class="btn-wrap">
        <?php $str = preg_replace("/[^0-9]/", '', $phone);?>
        <a href="tel:<?php echo $str; ?>">
          <button class="btn-76 wow fadeInUp" data-wow-delay="0.2s"><?php echo $phone; ?></button>
        </a>
        <a href="mailto:<?php echo $email; ?>">
          <button class="btn-76 wow fadeInUp" data-wow-delay="0.4s"><?php echo $email; ?></button>
        </a>
        <a href="<?php echo $chat['url']?>" target="<?php echo $chat['target']; ?>"><button class="btn-80 wow fadeInUp" data-wow-delay="0.6s"><i></i><?php echo $chat['title'];?></button></a>
      </div>
    </div>
  </div>
</section>