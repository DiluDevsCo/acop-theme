<?php
use LearnDash\Course_Grid\Utilities;
// $steps = LDLMS_Factory_Post::course_steps(46);
// print_r($steps);
$user = wp_get_current_user();
$study_time = get_field('study_time');
$data = array();
if ($study_time) {
  for ($s = 0; $s < count($study_time); $s++) {
    $study_time_label = $study_time[$s]['label'];
    $months = $study_time[$s]['months'];
    $disable_button = $study_time[$s]['disable_button'];
    $disabled_message = $study_time[$s]['disabled_message'];
    $data[$s] = array(
      'label' => $study_time_label,
      'months' => array(),
      'disabled' => $disable_button,
      'disabled_message' => $disabled_message
    );

    if ($months) {
      for ($m = 0; $m < count($months); $m++) {
        $label = $months[$m]['label'];
        $days = $months[$m]['days'];
        $data[$s]['months'][$m] = array(
          'label' => $label,
          "lessons" => '15 lecciones', // TODO: Obtener de learndash
          "study_days" => '20 dias de estudio',// TODO: Obtener de learndash
          "duration" => '20 horas',// TODO: Obtener de learndash
          'days' => array()
        );

        if ($days) {
          for ($i = 0; $i < count($days); $i++) {
            $day = $days[$i];
            $label = $day['label'];
            $topics = $day['topics'];
            $data[$s]['months'][$m]['days'][$i] = array(
              'label' => $label,
              'topics' => array()
            );
            
            if ($topics) {
              for ($j = 0; $j < count($topics); $j++) {
                $topic = $topics[$j]['topic'];
                $url = $topics[$j]['url'];
                $label = $topics[$j]['label'];
                if ($topic) {
                  $data[$s]['months'][$m]['days'][$i]['topics'][$j] = array(
                    'ID' => $topic->ID,
                    'title' => get_the_title($topic->ID),
                    'url' => get_permalink($topic->ID),
                    "duration" => Utilities::get_duration($topic->ID, 'output'),
                    'completed'=> learndash_is_topic_complete(get_current_user_id(), $topic->ID )
                  );
                } else {
                  $data[$s]['months'][$m]['days'][$i]['topics'][$j] = array(
                    'ID' => null,
                    'title' => $label,
                    'url' => $url,
                    "duration" => "N/A", // TODO: Obtener de leardash
                    'completed'=> false
                  );
                }
              }
            }
          }
        }
      }
    }
  }
}

if ($user) :
?>
<calendario-block class="not-prose" input-data='data-input-:<?php echo esc_attr(wp_json_encode($data));?>'>
</calendario-block>
<?php endif; ?>