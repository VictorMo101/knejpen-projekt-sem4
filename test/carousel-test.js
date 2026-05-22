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
const getScrollMetrics = ClientFunction(() => {
	const wrapper = document.getElementById('eventsWrapper');
	if (!wrapper) {
		return { scrollWidth: 0, clientWidth: 0 };
	}

	return { scrollWidth: wrapper.scrollWidth, clientWidth: wrapper.clientWidth };
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
	if (cardCount === 0) {
		return;
	}
	const rightHidden = await scrollRight.hasClass('is-hidden');
	const metrics = await getScrollMetrics();
	const isScrollable = metrics.scrollWidth > metrics.clientWidth + 2;

	if (isScrollable && !rightHidden && cardCount > 3) {
		const initialScroll = await getScrollLeft();

		await t.click(scrollRight);
		await t.click(scrollRight);
		await t.expect(getScrollLeft()).gt(initialScroll, 'Carousel did not scroll right');

		const leftHidden = await scrollLeft.hasClass('is-hidden');
		if (!leftHidden && await scrollLeft.visible) {
			await t.click(scrollLeft);
			await t.click(scrollLeft);
			await t.expect(getScrollLeft()).eql(initialScroll, 'Carousel did not return to start');
		}
	}

	const eventLink = eventsWrapper.find('a').nth(0);
	const eventHref = await eventLink.getAttribute('href');
	const eventTarget = await eventLink.getAttribute('target');

	await t.expect(eventLink.exists).ok('Missing event card link');
	await t.expect(eventHref).ok('Event card link has no href');
	await t.expect(eventTarget).eql('_blank', 'Event card link should open in a new tab');

	const expectedUrl = new URL(eventHref);

	await t.navigateTo(eventHref);

	const actualParts = await getUrlParts();
	await t.expect(actualParts.host).eql(expectedUrl.host, 'Event link host mismatch');

	const allowedPaths = expectedUrl.host.includes('facebook.com')
		? [expectedUrl.pathname, '/login', '/checkpoint', '/privacy']
		: [expectedUrl.pathname];
	const pathOk = allowedPaths.some((path) => actualParts.pathname.startsWith(path));
	await t.expect(pathOk).ok('Event link path mismatch');
});
