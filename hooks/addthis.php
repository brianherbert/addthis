<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Add This - Load All Events
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author       Ushahidi Team <team@ushahidi.com>
 * @package       Ushahidi - http://source.ushahididev.com
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license       http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */

class addthis {


    /**
     * Registers the main event add method
     */

    public function __construct()
    {
        // Hook into rounting
        Event::add('system.pre_controller', array($this, 'add'));
    }

    /**
     * Adds events to the ushahidi application
     */
    public function add()
    {
        Event::add('ushahidi_action.report_view_sidebar', array($this, '_place_addthis'));
        Event::add('ushahidi_action.main_sidebar', array($this, '_place_addthis_main'));
    }

    /**
     * Place adsense
     */
    public function _place_addthis()
    {
        $addthis_code = $this->_addthis_code();
        $addthis = View::factory('addthis');
        $addthis->addthis_code = $addthis_code;
        $addthis->render(TRUE);
    }

    /**
     * Place adsense
     */
    public function _place_addthis_main()
    {
        $addthis_code = '<br/>';
        $addthis_code .= $this->_addthis_code();
        $addthis = View::factory('addthis');
        $addthis->addthis_code = $addthis_code;
        $addthis->render(TRUE);
    }

    public function _addthis_code()
    {

        $theme = Kohana::config('settings.site_style');

        // Determine AddThis style to use
        if ($theme == 'unicorn')
        {
            // Small style
            $at_style = '';
            $css = 'float:right;margin:5px 0px;';
        }
        else
        {
            // Big style
            $at_style = 'addthis_32x32_style';
            $css = 'margin-bottom:15px;';
        }

        $pubid = Kohana::config('addthis.pubid');

        $addthis_code = '
            <div id="addthis-code" style="'.$css.'">
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style '.$at_style.'">
            <a class="addthis_button_preferred_1"></a>
            <a class="addthis_button_preferred_2"></a>
            <a class="addthis_button_preferred_3"></a>
            <a class="addthis_button_preferred_4"></a>
            <a class="addthis_button_compact"></a>
            <a class="addthis_counter addthis_bubble_style"></a>
            </div>
            <script type="text/javascript" src="https://s7.addthis.com/js/250/addthis_widget.js#pubid='.$pubid.'"></script>
            <!-- AddThis Button END -->
            </div>
        ';

        return $addthis_code;
    }
}

new addthis();
