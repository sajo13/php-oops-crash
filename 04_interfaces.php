<?php

// An interface defines a contract for what methods a class must implement,
// but it cannot provide any method implementations itself. Classes that implement 
// an interface must provide their own implementation for all the methods declared in the interface.

// Characteristics of an Interface:
// Only method declarations: An interface can only declare methods; it cannot provide method implementations.
// No properties: Interfaces cannot have properties or variables. They can only declare constants.
// Multiple inheritance: A class can implement multiple interfaces, 
// allowing for more flexibility in terms of combining behavior from multiple sources.
// No constructors: Interfaces cannot have constructors.

class Subscription
{
    public function __construct(
        protected BillingPortal $BillingPortal // Injecting the BillingPortal dependency
    ){ 
        // Constructor to initialize the BillingPortal object
    }

    // Create a new subscription or customer
    public function create()
    {
        $this->BillingPortal->getCustomer(); // Call the getCustomer() method of the injected BillingPortal
        echo "Customer created.\n";
    }

    // Cancel the subscription
    public function cancel()
    {
        echo "Subscription canceled.\n";
    }

    // Swap to a new plan
    public function swap(string $newPlan)
    {
        echo "Swapped to new plan: $newPlan.\n";
    }

    // Invoice the customer
    public function invoice()
    {
        echo "Invoice generated.\n";
    }
}

interface BillingPortal
{
    // Method declarations
    public function getCustomer();
    public function getSubscription();
}

class StripeBillingPortal implements BillingPortal
{
    // Implementing the getCustomer method
    public function getCustomer()
    {
        echo "Fetching customer from Stripe.\n";
    }

    // Implementing the getSubscription method
    public function getSubscription()
    {
        echo "Fetching subscription from Stripe.\n";
    }
}

class brainTreeBillingPortal implements BillingPortal
{
    // Implementing the getCustomer method
    public function getCustomer()
    {
        echo "Fetching customer from Braintree.\n";
    }

    // Implementing the getSubscription method
    public function getSubscription()
    {
        echo "Fetching subscription from Braintree.\n";
    }
}

// Example usage of the Subscription class with StripeBillingPortal
$subscription = new Subscription(
    new StripeBillingPortal() // Injecting StripeBillingPortal as the billing portal
);

// Creating a new subscription
$subscription->create(); // Outputs: "Fetching customer from Stripe." and "Customer created."

// Example usage of the Subscription class with brainTreeBillingPortal
$subscriptionBraintree = new Subscription(
    new brainTreeBillingPortal() // Injecting brainTreeBillingPortal as the billing portal
);

// Creating a new subscription
$subscriptionBraintree->create(); // Outputs: "Fetching customer from Braintree." and "Customer created."

