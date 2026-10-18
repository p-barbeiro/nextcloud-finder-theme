<?php

declare(strict_types=1);

namespace OCA\FinderTheme\Listener;

use OCA\FinderTheme\AppInfo\Application;
use OCP\AppFramework\Http\Events\BeforeTemplateRenderedEvent;
use OCP\EventDispatcher\Event;
use OCP\EventDispatcher\IEventListener;
use OCP\Util;

/**
 * Loads the theme on logged-in pages. The scripts only act on the Files app.
 *
 * @template-implements IEventListener<BeforeTemplateRenderedEvent>
 */
class LoadAssetsListener implements IEventListener {
	public function handle(Event $event): void {
		if (!$event instanceof BeforeTemplateRenderedEvent || !$event->isLoggedIn()) {
			return;
		}
		Util::addStyle(Application::APP_ID, 'finder');
		Util::addScript(Application::APP_ID, 'rail');
	}
}
