<?php
/**
 *
 * Spread Firefox. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018, aurelienazerty, https://www.team-azerty.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace aurelienazerty\spreadfirefox\event;

/**
 * @ignore
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Spread Firefox Event listener.
 */
class main_listener implements EventSubscriberInterface
{
	
	/** @var \phpbb\template\template $template */
	protected $template;
	/** @var \phpbb\user $user */
	protected $user;
    /** @var \phpbb\language\language $language */
    protected $language;
	
	/**
	 * Constructor
	 *
	 * @param \phpbb\template\template $template the template object
	 * @param \phpbb\user	$user	user object
     * @param \phpbb\language\language $language language object
	 * @access public
	 */
	public function __construct(\phpbb\template\template $template, \phpbb\user $user, \phpbb\language\language $language)
	{
		$this->template = $template;
		$this->user = $user;
        $this->language = $language;
	}
	
	static public function getSubscribedEvents()
	{
		return array(
			'core.page_header'	=> 'spread_the_word',
		);
	}

	/**
	 * A sample PHP event
	 * Modifies the names of the forums on index
	 *
	 * @param \phpbb\event\data	$event	Event object
	 */
	public function spread_the_word($event)
	{
        $this->language->add_lang('spread_firefox', 'aurelienazerty/spreadfirefox');
		$this->template->assign_var('NOT_USING_FIREFOX'	, ($this->user->data['user_type'] != 2 && preg_match("/Firefox/i", $this->user->browser) == 0));
		$this->template->assign_var('SPREAD_FIREFOX_MESSAGE'	, $this->user->lang['SPREAD_THE_WORD']);
		$this->template->assign_var('SPREAD_FIREFOX_DOWNLOAD_MESSAGE'	, $this->language->lang('DOWNLOAD_TEXT'));
	}
}
