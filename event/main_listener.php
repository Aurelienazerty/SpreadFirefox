<?php
/**
 *
 * Spread Firefox. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018, Aurelienazerty, https://www.team-azerty.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace Aurelienazerty\SpreadFirefox\event;

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
	
	/**
	 * Constructor
	 *
	 * @param \phpbb\template\template $template the template object
	 * @param \phpbb\user	$user	user object
	 * @access public
	 */
	public function __construct(\phpbb\template\template $template, \phpbb\user $user)
	{
		$this->template = $template;
		$this->user = $user;
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
		$this->user->add_lang_ext('Aurelienazerty/SpreadFirefox', 'spread_firefox');
		$this->template->assign_var('NOT_USING_FIREFOX'	, (preg_match("/Firefox/i", $this->user->browser) == 0));
		$this->template->assign_var('SPREAD_FIREFOX_MESSAGE'	, $this->user->lang['SPREAD_THE_WORD']);
		$this->template->assign_var('SPREAD_FIREFOX_DOWNLOAD_MESSAGE'	, $this->user->lang['DOWNLOAD_TEXT']);
	}
}
