<?php
/**
	Used to display the dashboard modules. Every modules have a link to the User page (See the UserController).
 * - User details
 * - Lasts bills
 * - Main address / last recorded address
 * - Wishlist
 * - Suggested products
 * ....
 */

namespace User\UserBundle\Controller;


use User\UserBundle\Entity\User;

class DashboardController {

	public function dashboardModuleUserDetails(User $user){
		//... TODO: get the em and send the datas to a custom view for the module
	}

	public function dashboardModuleLastsBills(User $user){
		//... TODO: get the em and send the datas to a custom view for the module
	}

	public function dashboardModuleAddress(User $user){
		//... TODO: get the em and send the datas to a custom view for the module
	}

	public function dashboardModuleWishlist(User $user){
		//... TODO: get the em and send the datas to a custom view for the module
	}


}