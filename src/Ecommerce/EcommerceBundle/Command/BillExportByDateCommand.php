<?php

namespace Ecommerce\EcommerceBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class BillExportByDateCommand extends ContainerAwareCommand{

	protected function configure(){
		$this
			->setName('bill:export')
			->setDescription('Export the bill by date')
			->addArgument('date', InputArgument::OPTIONAL, 'Start date');
	}

	protected function execute( InputInterface $input, OutputInterface $output ) {
		$date   = new \DateTime();
		$bills   = $this->getContainer()->get('doctrine')->getManager()->getRepository('EcommerceBundle:UserOrder')->getBillsByDate( $input->getArgument('date') );

		$output->writeln( count( $bills ).'facture(s) created' );

		if( count( $bills ) > 0 ){
			$baseTargetDir  = 'src/Ecommerce/Billing/';
			$targetDir      = $date->format( 'd-m-Y h-i-s' ).'/';
			mkdir('src/Ecommerce/Billing/'.$targetDir);

			foreach( $bills as $bill ){
				$html2pdf   = $this->getContainer()->get('ecommerce.order_html2pdf');
				$template   = $this->getContainer()->get('templating')->render("UserBundle:Default:dashboard_bill.html.twig", array('bill' => $bill ) );
				$name       = $bill->getId().'_'.$bill->getOrderfullref();

				$html2pdf->create( 'P','A4', 'fr', true, 'UTF-8', array(5, 5, 5, 8) );
				$html2pdf->generatePdfOnDisk($baseTargetDir.$targetDir,$template, $name, 'F');
			}
		}
	}

}