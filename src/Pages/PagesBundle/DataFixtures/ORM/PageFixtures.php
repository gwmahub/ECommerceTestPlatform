<?php

namespace Pages\PagesBundle\DataFixtures\ORM;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Pages\PagesBundle\Entity\Page;

class PageFixtures extends Fixture {

	public function load( ObjectManager $manager ) {

		$page_cgv = new Page();
		$page_cgv->setTitle('CGV');
		$page_cgv->setExcerpt('
			<h2>Sous-titre 1 des CGV</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget placerat purus. Sed quis est vitae quam facilisis rhoncus. Donec accumsan venenatis magna, sit amet tempor...</p>
		');
		$page_cgv->setContent('
			<h2>Sous-titre 1 des CGV</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget placerat purus. Sed quis est vitae quam facilisis rhoncus. Donec accumsan venenatis magna, sit amet tempor nibh ullamcorper vel.</p>
			<p>Maecenas luctus accumsan lorem, ut maximus mauris facilisis ut. Integer suscipit massa a risus ornare ultricies. Maecenas quis mauris ante.</p>
			<p>Nunc efficitur et leo semper scelerisque. Nulla malesuada odio neque, ac luctus nisi mollis luctus. Nulla sit amet interdum nunc, sed ultrices quam. Mauris interdum tortor libero, eu molestie neque luctus in. Vestibulum lacus arcu, aliquam vitae dolor ac, ornare molestie lorem.</p>
			<h2>Sous-titre 2 des CGV</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget placerat purus. Sed quis est vitae quam facilisis rhoncus. Donec accumsan venenatis magna, sit amet tempor nibh ullamcorper vel.</p>
			<p>Maecenas luctus accumsan lorem, ut maximus mauris facilisis ut. Integer suscipit massa a risus ornare ultricies. Maecenas quis mauris ante.</p>
			<p>Nunc efficitur et leo semper scelerisque. Nulla malesuada odio neque, ac luctus nisi mollis luctus. Nulla sit amet interdum nunc, sed ultrices quam. Mauris interdum tortor libero, eu molestie neque luctus in. Vestibulum lacus arcu, aliquam vitae dolor ac, ornare molestie lorem.</p>
			<h2>Sous-titre 3 des CGV</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget placerat purus. Sed quis est vitae quam facilisis rhoncus. Donec accumsan venenatis magna, sit amet tempor nibh ullamcorper vel.</p>
			<p>Maecenas luctus accumsan lorem, ut maximus mauris facilisis ut. Integer suscipit massa a risus ornare ultricies. Maecenas quis mauris ante.</p>
			<p>Nunc efficitur et leo semper scelerisque. Nulla malesuada odio neque, ac luctus nisi mollis luctus. Nulla sit amet interdum nunc, sed ultrices quam. Mauris interdum tortor libero, eu molestie neque luctus in. Vestibulum lacus arcu, aliquam vitae dolor ac, ornare molestie lorem.</p>
		');
		$page_cgv->setStatus('published');
		$page_cgv->setCreatedat( new \DateTime() );
		$manager->persist($page_cgv);

		$page_mleg = new Page();
		$page_mleg->setTitle('Mentions Légales');
		$page_mleg->setExcerpt('
			<h2>Sous-titre 1 des Mentions Légales</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget placerat purus. Sed quis est vitae quam facilisis rhoncus. Donec accumsan venenatis magna, sit amet tempor...</p>
		');
		$page_mleg->setContent('
			<h2>Sous-titre 1 des Mentions Légales</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget placerat purus. Sed quis est vitae quam facilisis rhoncus. Donec accumsan venenatis magna, sit amet tempor nibh ullamcorper vel.</p>
			<p>Maecenas luctus accumsan lorem, ut maximus mauris facilisis ut. Integer suscipit massa a risus ornare ultricies. Maecenas quis mauris ante.</p>
			<p>Nunc efficitur et leo semper scelerisque. Nulla malesuada odio neque, ac luctus nisi mollis luctus. Nulla sit amet interdum nunc, sed ultrices quam. Mauris interdum tortor libero, eu molestie neque luctus in. Vestibulum lacus arcu, aliquam vitae dolor ac, ornare molestie lorem.</p>
			<h2>Sous-titre 2 des Mentions Légales</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget placerat purus. Sed quis est vitae quam facilisis rhoncus. Donec accumsan venenatis magna, sit amet tempor nibh ullamcorper vel.</p>
			<p>Maecenas luctus accumsan lorem, ut maximus mauris facilisis ut. Integer suscipit massa a risus ornare ultricies. Maecenas quis mauris ante.</p>
			<p>Nunc efficitur et leo semper scelerisque. Nulla malesuada odio neque, ac luctus nisi mollis luctus. Nulla sit amet interdum nunc, sed ultrices quam. Mauris interdum tortor libero, eu molestie neque luctus in. Vestibulum lacus arcu, aliquam vitae dolor ac, ornare molestie lorem.</p>
			<h2>Sous-titre 3 des Mentions Légales</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget placerat purus. Sed quis est vitae quam facilisis rhoncus. Donec accumsan venenatis magna, sit amet tempor nibh ullamcorper vel.</p>
			<p>Maecenas luctus accumsan lorem, ut maximus mauris facilisis ut. Integer suscipit massa a risus ornare ultricies. Maecenas quis mauris ante.</p>
			<p>Nunc efficitur et leo semper scelerisque. Nulla malesuada odio neque, ac luctus nisi mollis luctus. Nulla sit amet interdum nunc, sed ultrices quam. Mauris interdum tortor libero, eu molestie neque luctus in. Vestibulum lacus arcu, aliquam vitae dolor ac, ornare molestie lorem.</p>
		');
		$page_mleg->setStatus('published');
		$page_mleg->setCreatedat( new \DateTime() );
		$manager->persist($page_mleg);

		$manager->flush();

	}// END load()

}