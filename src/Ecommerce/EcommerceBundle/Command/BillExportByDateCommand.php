<?php

namespace Ecommerce\EcommerceBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class BillExportByDateCommand extends ContainerAwareCommand{

	protected function configure(){
		$this
			->setName('premier:test')
			->setDescription('Ceci est mon premier test de commande')
			->addArgument('date', InputArgument::OPTIONAL, 'Date du jour');
	}

	protected function execute( InputInterface $input, OutputInterface $output ) {
		$date = $input->getArgument('date');
		if( $date == '16/01/2018' ){
			$output->writeln('Today');
		}else{
			$output->writeln($date);
		}
	}

}