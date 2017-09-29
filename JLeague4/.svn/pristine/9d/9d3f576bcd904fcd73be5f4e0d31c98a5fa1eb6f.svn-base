
JLeague - League Management Extension for Joomla.
--------------------------------------------------------------------------------------------
3.1.5 -
	* Added function to remove 'Delete' option for campaigns where the # of clicks is > 0
	* Updated comments in various modules
	* Added a CC to the original team owner
	* Fixed WinLoss logic in the Team Profile view to render a "T" for Ties
	
3.1.4 - 
	* Started development on the FOLLOW ME option for a team.
	* Resolved errors with the GameDAO to correctly report the username who inserted/updated
		the game data.
	* Changed CURDATE in gamedao to NOW()
	* Fixed DELETE function on the Registration classes in the backend administration
	* Added capability to view configuration settings from the frontend of the site
	* Added security check to calculate stats and RPI functions in the frontend controller
	* Fixed issue with SEASON CLOSE function to set the status to "CLOSED"
	* Added STATUS column to the seasons list (backend only)
	* Added CHECK to ensure they cannot edit/update roster and schedule if no active season is available.
	* Resolved ROUTER issues to ensure SEO compatibility
	* Updated comments within the code
	* Updated VIEW TEAM profile to support custom META data when the profile page is displayed.
	* Added CSS styling for alternate rows on the "look whos coming" template.
	* Added onChangeOwner event notification
	* Added sponsor/campaign tracking functionality
	* Implemented logic to prevent score postings based on configuration value
	* Fixed the Standings list in the admin section to show names of league, divisions and season
	* Moved getRequestParam from JLUtil to the core library.  Deprecated function in JLUtil
		
3.1.3 -
	* Fixed jQuery conflict with the Yootheme Wedgekit
	* Moved registration check to make prevent duplicate registrations (existing teams only).
	* Added DIFF column to the standings table
	* Added highlighted ROWS within the standings table
	* Modified standings page to have each division treated as a separate table.  Also modified
		jleague.css to support spacing between division tables
	* Support for "Suspended" games that can be edited later.
	* Added link on the standings plugin for the team profile view.
	* Cleaned up, and enhanced, template/view code to simplify generating of templates
	* Added addtional Season statistics in the backend
	* Abstracted JText Joomla function from rest of code and replaced it with JLText::getText
	
3.1.2 -
	* Added "(NEW)" indicator on the Look Who's Coming templae
	* Resolved Registration DAO error where the "registered by" value was not being persisted
	* Added Entered By, Updated By, and updated date to the Scores table.
	
3.1.1 -
	* Online registration for existing and new teams

3.0.23 -
	* Fixed issues with the DELETE function.  The controller was looking for a boolean 
		but the core DAO function was throwing an exception.  An ERROR was being thrown when
		trying to delete a game score.
	
3.0.22 - 02/05/2010 
	* Fixed issue dealing with the presentment of the teams website on the page.
	* Created drop-down select list for the team profile menu options. The normal submenu
		will be deprecated in several months.
	
3.0.21 - 02/01/2010
	* Added form validation to ensure a field/venue was selected prior to letting it be added
		to the team.
	* Modified team list page to include the USSSA number and classification
	* Modified sort sequence when retrieving the simple roster (lastname, firstname)
	* Changed team profile page to display team website as a <a href="">Click here</a> instead of just
		display its value.
		
3.0.20 - 01/14/2010
	* Resolved issues with the contact list processing.
	* Updated SQL to determine if a user is associated with a team.
	* Modified team profile template
	* Added quick view popup of the team profile
	* Enabled caching
	
3.0.19 - 01/10/2010
	* Fixed issue with TeamDAO object when pulling venues and the venueid = 0.  Removed the 
		throwing of an exception.
	* Added URL link for opening the USSSA Team page from the SWIBL team profile.
	* Added capability to generate a restrictedteam contact list.
	* Resolved User Preference issue when the user is new.  A fatal error was being thrown.
	* Minor LANGUAGE fixes
		
3.0.18 - 01/04/2010
	* Modified ROSTER processing.  Simplified the underlying table structure and data entry
		forms.
	* Resolved WARNING/ISSUE messages when editing seasons.
	* Removed email address from the team profile (incl. team contacts).
	
3.0.17 - 12/28/2010
	* Corrected the registration DAO object INSERT function to include phone and cellphone
	* Updated the Venue DAO object to sort the venues based on name and filter only those 
		locations that have been published.
	* Added Profile home to the Team Profile Submenu to take the user out of EDIT mode.
	* Added helper function to obtain username based on id
	* added Profile Owner to the display of a team profile.
	* Added runs allowed and runs scored to the standings page.
	* Language updates. 
	
3.0.16 - 12/21/2010
 	* Modified Team Registration object to show "Unassigned" if team hasn't been assigned to a division.
 	* Changed standings page to default to either a COMPLETED or PENDING season.  The PENDING page
 		will be a "looks whos coming" template.
 	* Updated the listteams function to show teams from PENDING seasons.
 	* Modified the method to handle Fields and Venues on the team profile.
 		
3.0.15 - 12/21/2010
	* Modified SEASON table to include a status column (A=Active, C=Completed, P=Pending)
	* Updated registration process on the backend
	* Updated the STANDINGS page to look at the latest COMPLETED season when defaulting the 
		standings view.
	* Added NOTE on the standings page to indicate if the season has been completed.
	* Added capability to list teams from previous seasons.
	 
3.0.12 -
	* Added EDIT function to players on a teams ROSTER
	* Added POST SCORE option on Manage Game / Score to force COMPLETION when selecting this option
		to avoid games being submitted without completing.
	
3.0.11 - 
	* Added helper function to retrieve Joomla DBO object from the core application library
	* Added additional security check to limit access to team roster.
	* Modified Teams controller to support season level access to the roster.  
	
3.0.10 - March 7, 2010

	* Added quicklinks function for easier navigation to team pages.
	* Roster support
	* Support to define a User Preferences page where a user can define a landing page.
	* On Player creation page, make the date of birth a required field.
	* Added additional context to error messages.
	

	 