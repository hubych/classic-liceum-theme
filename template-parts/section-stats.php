<?php
/**
 * Секція статистики. Контент — 3 пари "цифра + підпис" з ACF.
 */

defined( 'ABSPATH' ) || exit;

$stats = array(
	array(
		'number' => get_field( 'stat1_number' ),
		'label'  => get_field( 'stat1_label' ),
	),
	array(
		'number' => get_field( 'stat2_number' ),
		'label'  => get_field( 'stat2_label' ),
	),
	array(
		'number' => get_field( 'stat3_number' ),
		'label'  => get_field( 'stat3_label' ),
	),
);
?>

<section class="stats">
	<div class="stats__inner">
		<div class="stats__box">
			<?php foreach ( $stats as $stat ) : ?>
				<?php if ( empty( $stat['number'] ) ) { continue; } ?>
				<div class="stats__item">
					<span class="stats__number"><?php echo esc_html( $stat['number'] ); ?></span>
					<?php if ( $stat['label'] ) : ?>
						<span class="stats__label"><?php echo esc_html( $stat['label'] ); ?></span>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
