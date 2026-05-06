import { Selector } from 'testcafe';

fixture('random test')
	.page(process.env.TEST_URL);

test('checks home section exists', async t => {
	await t.expect(Selector('#home').exists).ok();
});
