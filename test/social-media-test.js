import { Selector, ClientFunction } from 'testcafe';
import 'dotenv/config';

const baseUrl = process.env.BASE_URL || 'https://knejpen-projekt.dk';
const getUrlParts = ClientFunction(() => ({
	host: window.location.host,
	pathname: window.location.pathname
}));
const setSocialTargetsSelf = ClientFunction(() => {
	const links = document.querySelectorAll('.social-grid a, .facebook-button');
	links.forEach((link) => link.setAttribute('target', '_self'));
});

const expectedUrls = {
	instagram: 'https://www.instagram.com/pub_knejpen',
	facebook: 'https://www.facebook.com/pubknejpen'
};

fixture('Social media links').page(baseUrl).skipJsErrors();

test('Footer and media social links navigate to correct URLs', async (t) => {
	const instagramLink = Selector('.social-grid a').withAttribute('aria-label', /Instagram/i);
	const facebookLink = Selector('.social-grid a').withAttribute('aria-label', /Facebook/i);
	const facebookButton = Selector('.facebook-button');

	await t.expect(instagramLink.exists).ok('Missing Instagram link in footer');
	await t.expect(facebookLink.exists).ok('Missing Facebook link in footer');
	await t.expect(facebookButton.exists).ok('Missing Facebook button in media section');

	const instagramHref = await instagramLink.getAttribute('href');
	const facebookHref = await facebookLink.getAttribute('href');
	const facebookButtonHref = await facebookButton.getAttribute('href');

	await t.expect(instagramHref).eql(expectedUrls.instagram, 'Instagram link mismatch');
	await t.expect(facebookHref).eql(expectedUrls.facebook, 'Facebook link mismatch');
	await t.expect(facebookButtonHref).eql(expectedUrls.facebook, 'Facebook button link mismatch');

	await t.expect(instagramLink.getAttribute('target')).eql('_blank', 'Instagram link should open in a new tab');
	await t.expect(facebookLink.getAttribute('target')).eql('_blank', 'Facebook link should open in a new tab');
	await t.expect(facebookButton.getAttribute('target')).eql('_blank', 'Facebook button should open in a new tab');

	await setSocialTargetsSelf();

	const checkUrl = async (href, allowedPaths) => {
		const expected = new URL(href);
		const actual = await getUrlParts();
		await t.expect(actual.host).eql(expected.host, 'Host mismatch after navigation');
		const pathOk = allowedPaths.some((path) => actual.pathname.startsWith(path));
		await t.expect(pathOk).ok('Path mismatch after navigation');
	};

	await t.click(instagramLink);
	await checkUrl(instagramHref, ['/pub_knejpen', '/accounts', '/consent', '/privacy', '/legal']);

	await t.navigateTo(baseUrl);
	await setSocialTargetsSelf();
	await t.click(facebookLink);
	await checkUrl(facebookHref, ['/pubknejpen']);

	await t.navigateTo(baseUrl);
	await setSocialTargetsSelf();
	await t.click(facebookButton);
	await checkUrl(facebookButtonHref, ['/pubknejpen']);
});
