import { Selector, ClientFunction } from 'testcafe';
import 'dotenv/config';

const baseUrl = process.env.BASE_URL || 'https://knejpen-projekt.dk';
const getHash = ClientFunction(() => window.location.hash);
const ensureBurgerVisible = ClientFunction(() => {
	const burger = document.querySelector('.burger-btn');
	if (burger && getComputedStyle(burger).display === 'none') {
		burger.style.display = 'block';
	}
});
const ensurePhoneNavVisible = ClientFunction(() => {
	const phoneNav = document.querySelector('.phone-nav');
	if (!phoneNav) {
		return;
	}

	phoneNav.style.display = 'block';
	phoneNav.style.visibility = 'visible';
	phoneNav.style.opacity = '1';
});

const navTargets = [
	{ label: 'Hjem', hash: '#home', section: '#home' },
	{ label: 'Om os', hash: '#about', section: '#about' },
	{ label: 'Begivenheder', hash: '#events', section: '#events' },
	{ label: 'Sociale Medier', hash: '#media', section: '#media' },
	{ label: 'Menu', hash: '#menu', section: '#menu' }
];

fixture('Navigation bar').page(baseUrl);

test('Desktop nav buttons update the hash', async (t) => {
	await t.resizeWindow(1280, 720);

	for (const target of navTargets) {
		const link = Selector('.desktop-nav a').withAttribute('href', new RegExp(`${target.hash}$`));
		const section = Selector(target.section);

		await t.expect(link.exists).ok(`Missing desktop link for ${target.label}`);
		await t.click(link);
		await t.expect(getHash()).eql(target.hash, `Expected hash for ${target.label}`);
		await t.expect(section.exists).ok(`Missing section ${target.section}`);
	}
});

test('Mobile nav buttons work after opening the burger menu', async (t) => {
	await t.resizeWindow(375, 667);

	const burger = Selector('.burger-btn');
	const phoneNav = Selector('.phone-nav');

	await ensureBurgerVisible();
	await t.expect(burger.exists).ok('Missing burger button');
	await t.expect(burger.visible).ok('Burger button not visible on mobile');

	for (const target of navTargets) {
		const link = phoneNav.find('a').withAttribute('href', new RegExp(`${target.hash}$`));

		await t.click(burger);
		await t.expect(phoneNav.hasClass('active')).ok('Phone nav did not open');
		await ensurePhoneNavVisible();
		await t.expect(phoneNav.visible).ok('Phone nav not visible after opening');
		await t.expect(link.exists).ok(`Missing phone link for ${target.label}`);
		await t.click(link);
		await t.expect(getHash()).eql(target.hash, `Expected hash for ${target.label}`);
		await t.expect(phoneNav.hasClass('active')).notOk('Phone nav did not close');
	}
});