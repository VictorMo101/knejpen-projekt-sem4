import { Selector, ClientFunction } from 'testcafe';
import 'dotenv/config';

const baseUrl = process.env.BASE_URL || 'https://knejpen-projekt.dk';
const getLocation = ClientFunction(() => window.location.href);
const getUrlParts = ClientFunction(() => ({
	host: window.location.host,
	pathname: window.location.pathname,
	search: decodeURIComponent(window.location.search)
}));
const getScrollLeft = ClientFunction(() => {
	const wrapper = document.getElementById('eventsWrapper');
	return wrapper ? wrapper.scrollLeft : 0;
});

fixture('Events carousel').page(baseUrl);

test('Carousel scrolls and event link opens', async (t) => {
	await t.resizeWindow(1280, 720);

	const eventsWrapper = Selector('#eventsWrapper');
	const scrollRight = Selector('#eventsScrollBtnRight');
	const scrollLeft = Selector('#eventsScrollBtnLeft');
	const eventCards = eventsWrapper.find('.event-card');

	await t.expect(eventsWrapper.exists).ok('Missing events wrapper');
	await t.expect(scrollRight.exists).ok('Missing right scroll button');
	await t.expect(scrollLeft.exists).ok('Missing left scroll button');
	const cardCount = await eventCards.count;
	const rightHidden = await scrollRight.hasClass('is-hidden');

	if (cardCount <= 3) {
		await t.expect(rightHidden).ok('Right scroll button should be hidden with <= 3 events');
		return;
	}

	await t.expect(rightHidden).notOk('Right scroll button is hidden');

	const initialScroll = await getScrollLeft();

	await t.click(scrollRight);
	await t.click(scrollRight);
	await t.expect(getScrollLeft()).gt(initialScroll, 'Carousel did not scroll right');

	await t.click(scrollLeft);
	await t.click(scrollLeft);
	await t.expect(getScrollLeft()).eql(initialScroll, 'Carousel did not return to start');

	const eventLink = eventsWrapper.find('a').nth(0);
	const eventHref = await eventLink.getAttribute('href');
	const eventTarget = await eventLink.getAttribute('target');

	await t.expect(eventLink.exists).ok('Missing event card link');
	await t.expect(eventHref).ok('Event card link has no href');
	await t.expect(eventTarget).eql('_blank', 'Event card link should open in a new tab');

	const expectedUrl = new URL(eventHref);

	await t.navigateTo(eventHref);
	await t.expect(getLocation()).contains(`${expectedUrl.protocol}//${expectedUrl.host}${expectedUrl.pathname}`, 'Event link did not open');

	const actualParts = await getUrlParts();
	await t.expect(actualParts.host).eql(expectedUrl.host, 'Event link host mismatch');
	await t.expect(actualParts.pathname).eql(expectedUrl.pathname, 'Event link path mismatch');
});
