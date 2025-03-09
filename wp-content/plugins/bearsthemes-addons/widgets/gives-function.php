<?php
/**
 * Common gives helper functions
 *
**/

function bearsthemes_addons_goal_progress($form_id, $args, $bar_opts) {
  $form        = new \Give_Donate_Form( $form_id );
  $goal_option = give_get_meta( $form->ID, '_give_goal_option', true );

  // Sanity check - ensure form has pass all condition to show goal.
  if ( ( isset( $args['show_goal'] ) && ! filter_var( $args['show_goal'], FILTER_VALIDATE_BOOLEAN ) )
     || empty( $form->ID )
     || ( is_singular( 'give_forms' ) && ! give_is_setting_enabled( $goal_option ) )
     || ! give_is_setting_enabled( $goal_option ) || 0 === $form->goal ) {
    return false;
  }

  $goal_format         = give_get_form_goal_format( $form_id );
  $price               = give_get_meta( $form_id, '_give_set_price', true );
  $color               = give_get_meta( $form_id, '_give_goal_color', true );
  $show_text           = isset( $args['show_text'] ) ? filter_var( $args['show_text'], FILTER_VALIDATE_BOOLEAN ) : true;
  $show_bar            = isset( $args['show_bar'] ) ? filter_var( $args['show_bar'], FILTER_VALIDATE_BOOLEAN ) : true;
  $goal_progress_stats = give_goal_progress_stats( $form );

  $income = $goal_progress_stats['raw_actual'];
  $goal   = $goal_progress_stats['raw_goal'];

  switch ( $goal_format ) {

    case 'donation':
      $progress           = $goal ? round( ( $income / $goal ) * 100, 2 ) : 0;
      $progress_bar_value = $income >= $goal ? 100 : $progress;
      break;

    case 'donors':
      $progress_bar_value = $goal ? round( ( $income / $goal ) * 100, 2 ) : 0;
      $progress           = $progress_bar_value;
      break;

    case 'percentage':
      $progress           = $goal ? round( ( $income / $goal ) * 100, 2 ) : 0;
      $progress_bar_value = $income >= $goal ? 100 : $progress;
      break;

    default:
      $progress           = $goal ? round( ( $income / $goal ) * 100, 2 ) : 0;
      $progress_bar_value = $income >= $goal ? 100 : $progress;
      break;

  }

  /**
   * Filter the goal progress output
   *
   * @since 1.8.8
   */
  $progress = apply_filters( 'give_goal_amount_funded_percentage_output', $progress, $form_id, $form );

  $data_attr = 'class="give-card__progress"';

  if( '' !== $args['custom_goal_progress'] ) {

    $data_attr = 'class="give-card__progress give-card__progress-custom"';

    foreach ( $bar_opts as $key => $value ) {
      $data_attr .= ' data-' . $key . '="' . esc_attr( $value ) . '"';
    }
  }


  echo '<div ' . $data_attr . '>';

  ?>
    <div class="give-goal-progress">
      <?php if ( ! empty( $show_text ) ) : ?>
        <div class="raised">
          <?php
          if ( 'amount' === $goal_format ) :

            /**
             * Filter the give currency.
             *
             * @since 1.8.17
             */
            $form_currency = apply_filters( 'give_goal_form_currency', give_get_currency( $form_id ), $form_id );

            /**
             * Filter the income formatting arguments.
             *
             * @since 1.8.17
             */
            $income_format_args = apply_filters(
              'give_goal_income_format_args',
              array(
                'sanitize' => false,
                'currency' => $form_currency,
                'decimal'  => false,
              ),
              $form_id
            );

            /**
             * Filter the goal formatting arguments.
             *
             * @since 1.8.17
             */
            $goal_format_args = apply_filters(
              'give_goal_amount_format_args',
              array(
                'sanitize' => false,
                'currency' => $form_currency,
                'decimal'  => false,
              ),
              $form_id
            );

            /**
             * This filter will be used to convert the goal amounts to different currencies.
             *
             * @since 2.5.4
             *
             * @param array $amounts List of goal amounts.
             * @param int   $form_id Donation Form ID.
             */
            $goal_amounts = apply_filters(
              'give_goal_amounts',
              array(
                $form_currency => $goal,
              ),
              $form_id
            );

            /**
             * This filter will be used to convert the income amounts to different currencies.
             *
             * @since 2.5.4
             *
             * @param array $amounts List of goal amounts.
             * @param int   $form_id Donation Form ID.
             */
            $income_amounts = apply_filters(
              'give_goal_raised_amounts',
              array(
                $form_currency => $income,
              ),
              $form_id
            );

            // Get human readable donation amount.
            $income = give_human_format_large_amount( give_format_amount( $income, $income_format_args ), array( 'currency' => $form_currency ) );
            $goal   = give_human_format_large_amount( give_format_amount( $goal, $goal_format_args ), array( 'currency' => $form_currency ) );

            // Format the human readable donation amount.
            $formatted_income = give_currency_filter(
              $income,
              array(
                'form_id' => $form_id,
              )
            );

            $formatted_goal = give_currency_filter(
              $goal,
              array(
                'form_id' => $form_id,
              )
            );

            echo sprintf(
              /* translators: 1: amount of income raised 2: goal target amount. */
              __( '<span class="raised-income"><span class="income" data-amounts="%1$s">%2$s</span> %5$s</span> <span class="raised-goal"><span class="goal-text" data-amounts="%3$s">%4$s</span> %6$s</span>', 'bearsthemes-addons' ),
              esc_attr( wp_json_encode( $income_amounts, JSON_PRETTY_PRINT ) ),
              esc_attr( $formatted_income ),
              esc_attr( wp_json_encode( $goal_amounts, JSON_PRETTY_PRINT ) ),
              esc_attr( $formatted_goal ),
              esc_html( $args['income_text'] ),
              esc_html( $args['goal_text'] )
            );

          elseif ( 'percentage' === $goal_format ) :

            echo sprintf( /* translators: %s: percentage of the amount raised compared to the goal target */
              __( '<span class="give-percentage">%s%%</span> funded', 'bearsthemes-addons' ),
              round( $progress )
            );

          elseif ( 'donation' === $goal_format ) :

            echo sprintf( /* translators: 1: total number of donations completed 2: total number of donations set as goal */
              _n(
                '<span class="income">%1$s</span> of <span class="goal-text">%2$s</span> donation',
                '<span class="income">%1$s</span> of <span class="goal-text">%2$s</span> donations',
                $goal,
                'bearsthemes-addons'
              ),
              give_format_amount( $income, array( 'decimal' => false ) ),
              give_format_amount( $goal, array( 'decimal' => false ) )
            );

          elseif ( 'donors' === $goal_format ) :

            echo sprintf( /* translators: 1: total number of donors completed 2: total number of donors set as goal */
              _n(
                '<span class="income">%1$s</span> of <span class="goal-text">%2$s</span> donor',
                '<span class="income">%1$s</span> of <span class="goal-text">%2$s</span> donors',
                $goal,
                'bearsthemes-addons'
              ),
              give_format_amount( $income, array( 'decimal' => false ) ),
              give_format_amount( $goal, array( 'decimal' => false ) )
            );

          endif;
          ?>
        </div>
      <?php endif; ?>


      <?php if ( ! empty( $show_bar ) ) : ?>
        <div class="give-progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"
           aria-valuenow="<?php echo esc_attr( $progress_bar_value ); ?>">
          <span style="width: <?php echo esc_attr( $progress_bar_value ); ?>%;
                           <?php
                          if ( ! empty( $color ) ) {
                            echo 'background-color:' . $color;
                          }
                          ?>
          "></span>
        </div><!-- /.give-progress-bar -->
      <?php endif; ?>

    </div><!-- /.goal-progress -->

  <?php
  echo '</div>';
}

function bearsthemes_addons_goal_totals_progress( $args, $bar_opts ) {
  // Total Earnings.
  $total = give_maybe_sanitize_amount( $args['total_earnings'] );

	// Total Goal.
	$total_goal = give_maybe_sanitize_amount( $args['total_goal'] );

  // Bail out if total goal is empty.
  if ( empty( $total_goal ) ) {
  	return false;
  }

  // Set Give total progress bar color.
  $color = apply_filters( 'give_totals_progress_color', '#2bc253' );

  // Give total.
  $total = ! empty( $total ) ? $total : 0;

  /**
   * Filter the goal progress output
   *
   * @since 2.1
   */
  $progress = round( ( $total / $total_goal ) * 100, 2 );

  // Set progress to 100 percentage if total > total_goal
  $progress = $total >= $total_goal ? 100 : $progress;
  $progress = apply_filters( 'give_goal_totals_funded_percentage_output', $progress, $total, $total_goal );

  $data_attr = 'class="give-card__progress"';

  if( $args['custom_goal_progress'] ) {

  	$data_attr = 'class="give-card__progress give-card__progress-custom"';

  	foreach ($bar_opts as $key => $value) {
  		$data_attr .= ' data-' . $key . '="' . esc_attr( $value ) . '"';
  	}
  }

  $currency = give_get_currency();
  $currency_symbol = give_currency_symbol( $currency );
  $currency_pos = give_get_currency_position();

  if( 'before' == $currency_pos ) {
    $total = $currency_symbol . give_format_amount( $total );
    $total_goal = $currency_symbol . give_format_amount( $total_goal );

  } else {
    $total = give_format_amount( $total ) . $currency_symbol;
    $total_goal = give_format_amount( $total_goal ) . $currency_symbol;
  }

  echo '<div ' . $data_attr . '>';
  ?>
  	<div class="give-goal-progress">
      <?php if ( $args['show_text'] ) : ?>
    		<div class="raised">
    			<?php
          echo sprintf(
            /* translators: 1: amount of income raised 2: goal target amount. */
            __( '<span class="raised-income"><span class="income">%1$s</span> %3$s</span> <span class="raised-goal"><span class="goal-text">%2$s</span> %4$s</span>', 'bearsthemes-addons' ),
            esc_html( $total ),
            esc_html( $total_goal ),
            esc_html( $args['income_text'] ),
            esc_html( $args['goal_text'] )
          );

    			?>
    		</div>
      <?php endif; ?>

      <?php if ( $args['show_bar'] ) : ?>
    		<div class="give-progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"
    			 aria-valuenow="<?php echo esc_attr( $progress ); ?>">
    				<span style="width: <?php echo esc_attr( $progress ); ?>%;
    												<?php
    												if ( ! empty( $color ) ) {
    													echo 'background-color:' . $color;
    												}
    												?>
    				"></span>
    		</div><!-- /.give-progress-bar -->
      <?php endif; ?>

  	</div><!-- /.goal-progress -->

  <?php
  echo '</div>';

}

function bearsthemes_addons_give_totals ( $args, $bar_opts ) {
  // Total Earnings.
  $total = give_maybe_sanitize_amount( $args['total_earnings'] );

	// Total Goal.
	$total_goal = give_maybe_sanitize_amount( $args['total_goal'] );

	/**
	 * Give Action fire before the shortcode is rendering is started.
	 *
	 * @since 2.1.4
	 *
	 * @param array $args shortcode attribute.
	 */
	do_action( 'give_totals_goal_shortcode_before_render', $args );

	// Build query based on cat, tag and Form ids.
	if ( ! empty( $args['cats'] ) || ! empty( $args['tags'] ) || ! empty( $args['ids'] ) ) {

		$form_ids = [];
		if ( ! empty( $args['ids'] ) ) {
      if( 'array' == gettype($args['ids']) ) {
        $form_ids =  $args['ids'];
      } else {
        $form_ids = array_filter( array_map( 'trim', explode( ',', $args['ids'] ) ) );
      }
		}

		/**
		 * Filter to modify WP Query for Total Goal.
		 *
		 * @since 2.1.4
		 *
		 * @param array WP query argument for Total Goal.
		 */
		$form_args = [
			'post_type'      => 'give_forms',
			'post_status'    => 'publish',
			'post__in'       => $form_ids,
			'posts_per_page' => - 1,
			'fields'         => 'ids',
			'tax_query'      => [
				'relation' => 'AND',
			],
		];

		if ( ! empty( $args['cats'] ) ) {
      if( 'array' == gettype($args['cats']) ) {
        $cats =  $args['cats'];
      } else {
        $cats = array_filter( array_map( 'trim', explode( ',', $args['cats'] ) ) );
      }

			$form_args['tax_query'][] = [
				'taxonomy' => 'give_forms_category',
				'terms'    => $cats,
			];
		}

		if ( ! empty( $args['tags'] ) ) {
      if( 'array' == gettype($args['tags']) ) {
        $cats =  $args['tags'];
      } else {
        $cats = array_filter( array_map( 'trim', explode( ',', $args['tags'] ) ) );
      }

			$form_args['tax_query'][] = [
				'taxonomy' => 'give_forms_tag',
				'terms'    => $tags,
			];
		}

		/**
		 * Filter to modify WP Query for Total Goal.
		 *
		 * @since 2.1.4
		 *
		 * @param array $form_args WP query argument for Total Goal.
		 *
		 * @return array $form_args WP query argument for Total Goal.
		 */
		$form_args = (array) apply_filters( 'give_totals_goal_shortcode_query_args', $form_args );

		$forms = new WP_Query( $form_args );

		if ( isset( $forms->posts ) ) {
			$total = 0;
			foreach ( $forms->posts as $post ) {
				$form_earning = give_get_meta( $post, '_give_form_earnings', true );
				$form_earning = ! empty( $form_earning ) ? $form_earning : 0;

				/**
				 * Update Form earnings.
				 *
				 * @since 2.1
				 *
				 * @param int    $post         Form ID.
				 * @param string $form_earning Total earning of Form.
				 * @param array $args shortcode attributes.
				 */
				$total += apply_filters( 'give_totals_form_earning', $form_earning, $post, $args );
			}
		}
	} // End if().

	// Append link with text.
	$donate_link = '';
	if ( ! empty( $args['link'] ) ) {
		$donate_link = sprintf( ' <a class="give-totals-text-link" href="%1$s">%2$s</a>', esc_url( $args['link'] ), esc_html( $args['link_text'] ) );
	}

	// Replace {total} in message.
	$message = str_replace(
		'{total}',
		give_currency_filter(
			give_format_amount(
				$total,
				[ 'sanitize' => false ]
			)
		),
		wp_kses_post( $args['message'] )
	);

	// Replace {total_goal} in message.
	$message = str_replace(
		'{total_goal}',
		give_currency_filter(
			give_format_amount(
				$total_goal,
				[ 'sanitize' => true ]
			)
		),
		$message
	);

	/**
	 * Update Give totals shortcode output.
	 *
	 * @since 2.1
	 *
	 * @param string $message Shortcode Message.
	 * @param array $args ShortCode attributes.
	 */
	$message = apply_filters( 'give_totals_shortcode_message', $message, $args );

	ob_start();
	?>
	<div class="give-totals-shortcode-wrap">
		<?php
		// Show Progress Bar if progress_bar set true.
		$show_progress_bar = isset( $args['progress_bar'] ) ? filter_var( $args['progress_bar'], FILTER_VALIDATE_BOOLEAN ) : true;
		if ( $show_progress_bar ) {
      $bar_args = array(
        'total_earnings' => $total,
        'total_goal' => $total_goal,
        'show_text' => filter_var( $args['show_text'], FILTER_VALIDATE_BOOLEAN ),
  			'show_bar' => filter_var( $args['show_bar'], FILTER_VALIDATE_BOOLEAN ),
  			'income_text' => $args['income_text'],
  			'goal_text' => $args['goal_text'],
        'custom_goal_progress' => filter_var( $args['custom_goal_progress'], FILTER_VALIDATE_BOOLEAN ),
      );

			bearsthemes_addons_goal_totals_progress( $bar_args, $bar_opts );
		}

		echo sprintf(
      '<div class="give-totals-message">%1$s%2$s</div>',
      $message,
      $donate_link
    );

		?>
	</div>
	<?php
	$give_totals_output = ob_get_clean();

	/**
	 * Give Action fire after the total goal shortcode rendering is end.
	 *
	 * @since 2.1.4
	 *
	 * @param array  $args               shortcode attribute.
	 * @param string $give_totals_output shortcode output.
	 */
	do_action( 'give_totals_goal_shortcode_after_render', $args, $give_totals_output );

	/**
	 * Give Totals Shortcode output.
	 *
	 * @since 2.1
	 *
	 * @param string $give_totals_output
	 */
	return apply_filters( 'give_totals_shortcode_output', $give_totals_output );

}

//////////
function bearsthemes_addons_goal_totals_progress_circle( $args, $bar_opts ) {
  // Total Earnings.
  $total = give_maybe_sanitize_amount( $args['total_earnings'] );

	// Total Goal.
	$total_goal = give_maybe_sanitize_amount( $args['total_goal'] );

  // Bail out if total goal is empty.
  if ( empty( $total_goal ) ) {
  	return false;
  }

  // Set Give total progress bar color.
  $color = apply_filters( 'give_totals_progress_color', '#2bc253' );

  // Give total.
  $total = ! empty( $total ) ? $total : 0;

  /**
   * Filter the goal progress output
   *
   * @since 2.1
   */
  $progress = round( ( $total / $total_goal ) * 100, 2 );

  // Set progress to 100 percentage if total > total_goal
  $progress = $total >= $total_goal ? 100 : $progress;
  $progress = apply_filters( 'give_goal_totals_funded_percentage_output', $progress, $total, $total_goal );

  $data_attr = 'class="give-card__progress"';

  if( $args['custom_goal_progress'] ) {

  	$data_attr = 'class="give-card__progress give-card__progress-custom"';

  	foreach ($bar_opts as $key => $value) {
  		$data_attr .= ' data-' . $key . '="' . esc_attr( $value ) . '"';
  	}
  }

  $currency = give_get_currency();
  $currency_symbol = give_currency_symbol( $currency );
  $currency_pos = give_get_currency_position();

  if( 'before' == $currency_pos ) {
    $total = $currency_symbol . give_format_amount( $total );
    $total_goal = $currency_symbol . give_format_amount( $total_goal );

  } else {
    $total = give_format_amount( $total ) . $currency_symbol;
    $total_goal = give_format_amount( $total_goal ) . $currency_symbol;
  }

  echo '<div ' . $data_attr . '>';
  ?>
  	<div class="give-goal-progress">

      <?php if ( $args['show_bar'] ) : ?>
    		<div class="give-progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"
    			 aria-valuenow="<?php echo esc_attr( $progress ); ?>">
    				<span style="width: <?php echo esc_attr( $progress ); ?>%;
    												<?php
    												if ( ! empty( $color ) ) {
    													echo 'background-color:' . $color;
    												}
    												?>
    				"></span>
    		</div><!-- /.give-progress-bar -->
      <?php endif; ?>

  	</div><!-- /.goal-progress -->
    <?php if ( $args['show_text'] ) : ?>
      <div class="raised">
        <?php
        echo sprintf(
          /* translators: 1: amount of income raised 2: goal target amount. */
          __( '<span class="raised-income">%3$s<span class="income">%1$s</span></span> <span class="raised-goal">%4$s<span class="goal-text">%2$s</span></span>', 'bearsthemes-addons' ),
          esc_html( $total ),
          esc_html( $total_goal ),
          esc_html( $args['income_text'] ),
          esc_html( $args['goal_text'] )
        );

        ?>
      </div>
    <?php endif; ?>

  <?php
  echo '</div>';

}
function bearsthemes_addons_give_totals_circle ( $args, $bar_opts ) {
  // Total Earnings.
  $total = give_maybe_sanitize_amount( $args['total_earnings'] );

	// Total Goal.
	$total_goal = give_maybe_sanitize_amount( $args['total_goal'] );

	/**
	 * Give Action fire before the shortcode is rendering is started.
	 *
	 * @since 2.1.4
	 *
	 * @param array $args shortcode attribute.
	 */
	do_action( 'give_totals_goal_shortcode_before_render', $args );

	// Build query based on cat, tag and Form ids.
	if ( ! empty( $args['cats'] ) || ! empty( $args['tags'] ) || ! empty( $args['ids'] ) ) {

		$form_ids = [];
		if ( ! empty( $args['ids'] ) ) {
      if( 'array' == gettype($args['ids']) ) {
        $form_ids =  $args['ids'];
      } else {
        $form_ids = array_filter( array_map( 'trim', explode( ',', $args['ids'] ) ) );
      }
		}

		/**
		 * Filter to modify WP Query for Total Goal.
		 *
		 * @since 2.1.4
		 *
		 * @param array WP query argument for Total Goal.
		 */
		$form_args = [
			'post_type'      => 'give_forms',
			'post_status'    => 'publish',
			'post__in'       => $form_ids,
			'posts_per_page' => - 1,
			'fields'         => 'ids',
			'tax_query'      => [
				'relation' => 'AND',
			],
		];

		if ( ! empty( $args['cats'] ) ) {
      if( 'array' == gettype($args['cats']) ) {
        $cats =  $args['cats'];
      } else {
        $cats = array_filter( array_map( 'trim', explode( ',', $args['cats'] ) ) );
      }

			$form_args['tax_query'][] = [
				'taxonomy' => 'give_forms_category',
				'terms'    => $cats,
			];
		}

		if ( ! empty( $args['tags'] ) ) {
      if( 'array' == gettype($args['tags']) ) {
        $cats =  $args['tags'];
      } else {
        $cats = array_filter( array_map( 'trim', explode( ',', $args['tags'] ) ) );
      }

			$form_args['tax_query'][] = [
				'taxonomy' => 'give_forms_tag',
				'terms'    => $tags,
			];
		}

		/**
		 * Filter to modify WP Query for Total Goal.
		 *
		 * @since 2.1.4
		 *
		 * @param array $form_args WP query argument for Total Goal.
		 *
		 * @return array $form_args WP query argument for Total Goal.
		 */
		$form_args = (array) apply_filters( 'give_totals_goal_shortcode_query_args', $form_args );

		$forms = new WP_Query( $form_args );

		if ( isset( $forms->posts ) ) {
			$total = 0;
			foreach ( $forms->posts as $post ) {
				$form_earning = give_get_meta( $post, '_give_form_earnings', true );
				$form_earning = ! empty( $form_earning ) ? $form_earning : 0;

				/**
				 * Update Form earnings.
				 *
				 * @since 2.1
				 *
				 * @param int    $post         Form ID.
				 * @param string $form_earning Total earning of Form.
				 * @param array $args shortcode attributes.
				 */
				$total += apply_filters( 'give_totals_form_earning', $form_earning, $post, $args );
			}
		}
	} // End if().

	// Append link with text.
	$donate_link = '';
	if ( ! empty( $args['link'] ) ) {
		$donate_link = sprintf( ' <a class="give-totals-text-link" href="%1$s">%2$s</a>', esc_url( $args['link'] ), esc_html( $args['link_text'] ) );
	}

	// Replace {total} in message.
	$message = str_replace(
		'{total}',
		give_currency_filter(
			give_format_amount(
				$total,
				[ 'sanitize' => false ]
			)
		),
		wp_kses_post( $args['message'] )
	);

	// Replace {total_goal} in message.
	$message = str_replace(
		'{total_goal}',
		give_currency_filter(
			give_format_amount(
				$total_goal,
				[ 'sanitize' => true ]
			)
		),
		$message
	);

	/**
	 * Update Give totals shortcode output.
	 *
	 * @since 2.1
	 *
	 * @param string $message Shortcode Message.
	 * @param array $args ShortCode attributes.
	 */
	$message = apply_filters( 'give_totals_shortcode_message', $message, $args );

	ob_start();
	?>
	<div class="give-totals-shortcode-wrap">
		<?php
		// Show Progress Bar if progress_bar set true.
		$show_progress_bar = isset( $args['progress_bar'] ) ? filter_var( $args['progress_bar'], FILTER_VALIDATE_BOOLEAN ) : true;
		if ( $show_progress_bar ) {
      $bar_args = array(
        'total_earnings' => $total,
        'total_goal' => $total_goal,
        'show_text' => filter_var( $args['show_text'], FILTER_VALIDATE_BOOLEAN ),
  			'show_bar' => filter_var( $args['show_bar'], FILTER_VALIDATE_BOOLEAN ),
  			'income_text' => $args['income_text'],
  			'goal_text' => $args['goal_text'],
        'custom_goal_progress' => filter_var( $args['custom_goal_progress'], FILTER_VALIDATE_BOOLEAN ),
      );

			bearsthemes_addons_goal_totals_progress_circle( $bar_args, $bar_opts );
		}

		echo sprintf(
      '<div class="give-totals-message">%1$s%2$s</div>',
      $message,
      $donate_link
    );

		?>
	</div>
	<?php
	$give_totals_output = ob_get_clean();

	/**
	 * Give Action fire after the total goal shortcode rendering is end.
	 *
	 * @since 2.1.4
	 *
	 * @param array  $args               shortcode attribute.
	 * @param string $give_totals_output shortcode output.
	 */
	do_action( 'give_totals_goal_shortcode_after_render', $args, $give_totals_output );

	/**
	 * Give Totals Shortcode output.
	 *
	 * @since 2.1
	 *
	 * @param string $give_totals_output
	 */
	return apply_filters( 'give_totals_shortcode_output', $give_totals_output );

}

///////////

function bearsthemes_addons_goal_totals_progress_box( $args, $bar_opts ) {
  // Total Earnings.
  $total = give_maybe_sanitize_amount( $args['total_earnings'] );

	// Total Goal.
	$total_goal = give_maybe_sanitize_amount( $args['total_goal'] );

  // Bail out if total goal is empty.
  if ( empty( $total_goal ) ) {
  	return false;
  }

  // Set Give total progress bar color.
  $color = apply_filters( 'give_totals_progress_color', '#2bc253' );

  // Give total.
  $total = ! empty( $total ) ? $total : 0;

  /**
   * Filter the goal progress output
   *
   * @since 2.1
   */
  $progress = round( ( $total / $total_goal ) * 100, 2 );

  // Set progress to 100 percentage if total > total_goal
  $progress = $total >= $total_goal ? 100 : $progress;
  $progress = apply_filters( 'give_goal_totals_funded_percentage_output', $progress, $total, $total_goal );

  $data_attr = 'class="give-card__progress"';

  if( $args['custom_goal_progress'] ) {

  	$data_attr = 'class="give-card__progress give-card__progress-custom"';

  	foreach ($bar_opts as $key => $value) {
  		$data_attr .= ' data-' . $key . '="' . esc_attr( $value ) . '"';
  	}
  }

  $currency = give_get_currency();
  $currency_symbol = give_currency_symbol( $currency );
  $currency_pos = give_get_currency_position();

  if( 'before' == $currency_pos ) {
    $total = $currency_symbol . give_format_amount( $total );
    $total_goal = $currency_symbol . number_format( $total_goal );

  } else {
    $total = give_format_amount( $total ) . $currency_symbol;
    $total_goal = number_format( $total_goal ) . $currency_symbol;
  }

  echo '<div ' . $data_attr . '>';
  ?>
  	<div class="give-goal-progress">

        <div class="bt-price">
          <?php
            echo '<div class="bt-goal">'.$total_goal.'</div>'.
              '<div class="bt-collected">'.$progress.esc_html__('% Donation Collected', 'bearsthemes-addons').'</div>';
          ?>
        </div>
        <div class="bt-progress">
        <span></span><span></span><span></span>
        <span></span><span></span><span></span>
        <span></span><span></span><span></span>

        <?php  echo '<div class="bt-percent" style="width: '.esc_attr($progress).'%;"> </div>'; ?>
        </div>

  	</div><!-- /.goal-progress -->

  <?php
  echo '</div>';

}

function bearsthemes_addons_give_totals_box ( $args, $bar_opts ) {
  // Total Earnings.
  $total = give_maybe_sanitize_amount( $args['total_earnings'] );

	// Total Goal.
	$total_goal = give_maybe_sanitize_amount( $args['total_goal'] );

	/**
	 * Give Action fire before the shortcode is rendering is started.
	 *
	 * @since 2.1.4
	 *
	 * @param array $args shortcode attribute.
	 */
	do_action( 'give_totals_goal_shortcode_before_render', $args );

	// Build query based on cat, tag and Form ids.
	if ( ! empty( $args['cats'] ) || ! empty( $args['tags'] ) || ! empty( $args['ids'] ) ) {

		$form_ids = [];
		if ( ! empty( $args['ids'] ) ) {
      if( 'array' == gettype($args['ids']) ) {
        $form_ids =  $args['ids'];
      } else {
        $form_ids = array_filter( array_map( 'trim', explode( ',', $args['ids'] ) ) );
      }
		}

		/**
		 * Filter to modify WP Query for Total Goal.
		 *
		 * @since 2.1.4
		 *
		 * @param array WP query argument for Total Goal.
		 */
		$form_args = [
			'post_type'      => 'give_forms',
			'post_status'    => 'publish',
			'post__in'       => $form_ids,
			'posts_per_page' => - 1,
			'fields'         => 'ids',
			'tax_query'      => [
				'relation' => 'AND',
			],
		];

		if ( ! empty( $args['cats'] ) ) {
      if( 'array' == gettype($args['cats']) ) {
        $cats =  $args['cats'];
      } else {
        $cats = array_filter( array_map( 'trim', explode( ',', $args['cats'] ) ) );
      }

			$form_args['tax_query'][] = [
				'taxonomy' => 'give_forms_category',
				'terms'    => $cats,
			];
		}

		if ( ! empty( $args['tags'] ) ) {
      if( 'array' == gettype($args['tags']) ) {
        $cats =  $args['tags'];
      } else {
        $cats = array_filter( array_map( 'trim', explode( ',', $args['tags'] ) ) );
      }

			$form_args['tax_query'][] = [
				'taxonomy' => 'give_forms_tag',
				'terms'    => $tags,
			];
		}

		/**
		 * Filter to modify WP Query for Total Goal.
		 *
		 * @since 2.1.4
		 *
		 * @param array $form_args WP query argument for Total Goal.
		 *
		 * @return array $form_args WP query argument for Total Goal.
		 */
		$form_args = (array) apply_filters( 'give_totals_goal_shortcode_query_args', $form_args );

		$forms = new WP_Query( $form_args );

		if ( isset( $forms->posts ) ) {
			$total = 0;
			foreach ( $forms->posts as $post ) {
				$form_earning = give_get_meta( $post, '_give_form_earnings', true );
				$form_earning = ! empty( $form_earning ) ? $form_earning : 0;

				/**
				 * Update Form earnings.
				 *
				 * @since 2.1
				 *
				 * @param int    $post         Form ID.
				 * @param string $form_earning Total earning of Form.
				 * @param array $args shortcode attributes.
				 */
				$total += apply_filters( 'give_totals_form_earning', $form_earning, $post, $args );
			}
		}
	} // End if().

	// Append link with text.
	$donate_link = '';
	if ( ! empty( $args['link'] ) ) {
		$donate_link = sprintf( ' <a class="give-totals-text-link" href="%1$s">%2$s</a>', esc_url( $args['link'] ), esc_html( $args['link_text'] ) );
	}

	// Replace {total} in message.
	$message = str_replace(
		'{total}',
		give_currency_filter(
			give_format_amount(
				$total,
				[ 'sanitize' => false ]
			)
		),
		wp_kses_post( $args['message'] )
	);

	// Replace {total_goal} in message.
	$message = str_replace(
		'{total_goal}',
		give_currency_filter(
			give_format_amount(
				$total_goal,
				[ 'sanitize' => true ]
			)
		),
		$message
	);

	/**
	 * Update Give totals shortcode output.
	 *
	 * @since 2.1
	 *
	 * @param string $message Shortcode Message.
	 * @param array $args ShortCode attributes.
	 */
	$message = apply_filters( 'give_totals_shortcode_message', $message, $args );

	ob_start();
	?>
	<div class="give-totals-shortcode-wrap">
		<?php
		// Show Progress Bar if progress_bar set true.
		$show_progress_bar = isset( $args['progress_bar'] ) ? filter_var( $args['progress_bar'], FILTER_VALIDATE_BOOLEAN ) : true;
		if ( $show_progress_bar ) {
      $bar_args = array(
        'total_earnings' => $total,
        'total_goal' => $total_goal,
        'show_text' => filter_var( $args['show_text'], FILTER_VALIDATE_BOOLEAN ),
  			'show_bar' => filter_var( $args['show_bar'], FILTER_VALIDATE_BOOLEAN ),
  			'income_text' => $args['income_text'],
  			'goal_text' => $args['goal_text'],
        'custom_goal_progress' => filter_var( $args['custom_goal_progress'], FILTER_VALIDATE_BOOLEAN ),
      );

			bearsthemes_addons_goal_totals_progress_box( $bar_args, $bar_opts );
		}

		echo sprintf(
      '<div class="give-totals-message">%1$s%2$s</div>',
      $message,
      $donate_link
    );

		?>
	</div>
	<?php
	$give_totals_output = ob_get_clean();

	/**
	 * Give Action fire after the total goal shortcode rendering is end.
	 *
	 * @since 2.1.4
	 *
	 * @param array  $args               shortcode attribute.
	 * @param string $give_totals_output shortcode output.
	 */
	do_action( 'give_totals_goal_shortcode_after_render', $args, $give_totals_output );

	/**
	 * Give Totals Shortcode output.
	 *
	 * @since 2.1
	 *
	 * @param string $give_totals_output
	 */
	return apply_filters( 'give_totals_shortcode_output', $give_totals_output );

}
